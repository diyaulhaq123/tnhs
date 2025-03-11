<?php

namespace App\Http\Controllers\Member;

use App\Models\Lga;
use App\Models\User;
use App\Models\State;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Unicodeveloper\Paystack\Facades\Paystack;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Member\MemberRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;

class MemberController extends Controller
{

    protected $memberRepo;
    protected $eventRepo;
    protected $payRepo;
    public function __construct(MemberRepositoryInterface $memberRepo, PaymentRepositoryInterface $payRepo,
        EventRepositoryInterface $eventRepo){
        $this->eventRepo = $eventRepo;
        $this->memberRepo = $memberRepo;
        $this->payRepo = $payRepo;
    }

    //
    public function dashboard(){
        $profile = auth()->user()->profile;
        // $events = $this->eventRepo->getByType(auth()->user()->type);
        $events = $this->eventRepo->get();
        return view('nhs.users.dashboard',compact('profile','events'));
    }

    public function biodata(Request $request){
        $lgas = Lga::select('name','id')->get();
        $states = State::select('name','id')->get();
        return view('nhs.biodata',compact('states','lgas'));
    }

    public function createProfile(CreateProfileRequest $request){
        $data = $request->validated();
        try{
                DB::beginTransaction();
                DB::commit();
                $this->memberRepo->createProfile($data);
                return redirect()->route('dashboards')->with('success', 'Profile saved!');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error Saving profile');
            Log::error($e->getMessage());
        }
    }

    public function updateProfile(UpdateProfileRequest $request){
        try{
                DB::beginTransaction();
                DB::commit();
                if($request->has('user_id')){
                    $this->memberRepo->updateProfile($request->user_id,$request->validated());
                }else{
                    $this->memberRepo->updateProfile(auth()->user()->id,$request->validated());
                }
                return redirect()->back()->with('success', 'Profile updated!');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error updating profile');
            Log::error($e->getMessage());
        }
    }

    public function uploadAvatar(Request $request){
        $data = $request->validate(['avatar' => 'required|image']);
        // dd(auth()->user()->staff->id);
        try{
            if(auth()->user()->profile && auth()->user()->profile->avatar != ''){
                Storage::disk('public')->delete(auth()->user()->profile->avatar);
            }
            $ext = $request->file('avatar')->extension();
            $content = file_get_contents($request->file('avatar'));
            $filename = Str::random(25);
            $avatar = '/avatars/'.$filename.'.'.$ext;
            Storage::disk('public')->put($avatar, $content);
            $this->memberRepo->addAvatar(auth()->user()->profile->id, $avatar);
            return redirect()->back()->with('success', 'Avatar was added');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Could not add avatar');
            Log::error($e->getMessage().date('Y-m-d'));
        }
    }


    public function storePayment(Request $request){
        return redirect()->back()->with('success', 'Hello it works!');
    }

    public function verifyPayment(Request $request){
        $ref = $request->reference;
        return view('nhs.jpost.event_pay_verify', compact('ref'));
    }


    public function redirectToGateway(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required',
            'payment_type_id' => 'required',
            'event_id' => 'required',
            'amount' => 'required',
        ]);
        // $pay = json_encode($data);

        try {
            $metadata = [
                'event_id' => $data['event_id'],
                'payment_type_id' => $data['payment_type_id'],
            ];

            $authorizationUrl = Paystack::getAuthorizationUrl([
                'metadata' => $metadata, // Pass the metadata array here
                'amount' => $request->amount,
                'email' => $request->email
            ])->redirectNow();
            return $authorizationUrl;
        } catch (\Exception $e) {
            // Handle exceptions
            Log::error($e->getMessage() . 'file:' . $e->getFile() .'line'. $e->getLine() );

            return Redirect::back()->with('error', 'The Paystack token has expired. Please refresh the page and try again.');
        }
    }


    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback(Request $request)
    {
        $paymentDetails = Paystack::getPaymentData();
        $amount = $paymentDetails['data']['amount']/100;
        $event = $paymentDetails['data']['metadata'];
        $payment_type_id = $paymentDetails['data']['metadata'];
        $this->payRepo->payEvent([
                'user_id' => auth()->user()->id,
                'payment_type_id' => $payment_type_id['payment_type_id'],
                'event_id' => $event['event_id'],
                'amount' => $amount,
                'reference' => $paymentDetails['data']['reference'],
                'remark' =>  $paymentDetails['data']['status']
            ]);

        return redirect()->back()->with('success', 'transaction successful');
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }



    public function lga(Request $request){
        $this->memberRepo->findLga($request->state);
        return view('nhs.jpost.lga',compact('lgas'));
    }


    public function show(Request $request){
        $member = User::where(['type' => '2', 'id' => $request->id])->first();
        $profile = optional($member->profile);
        $lgas = Lga::select('name','id')->get();
        $states = State::select('name','id')->get();
        return view('nhs.users.show', compact('member','profile','states','lgas'));
    }


    public function getLgas(Request $request){
        $lgas = Lga::select('name','id','state_id')->where('state_id', $request->state_id)->get();
        return json_encode($lgas);
    }


}
