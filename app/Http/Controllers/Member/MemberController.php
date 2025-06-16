<?php

namespace App\Http\Controllers\Member;

use App\Models\Lga;
use App\Models\User;
use App\Models\State;
use App\Models\Payment;
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
        if(auth()->user()->type == 2 && auth()->user()->status != 1){
            $membership = Payment::where([
                'payment_type_id' => 1,
                'remark' => 'success',
                'user_id' => auth()->user()->id
                ])->first();
            if($membership){
                User::find(auth()->user()->id)->update(['status' => 1]);
            }
        }
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
        $data = $request->validated();
        try{
                DB::beginTransaction();
                DB::commit();
                if($request->has('user_id')){
                    $profile = Profile::where('user_id', $request->user_id);
                    if($profile){
                        $this->memberRepo->updateProfile($request->user_id,$request->validated());
                    }else{
                        $data['user_id'] = $request->user_id;
                        $this->memberRepo->createProfile($data);
                    }
                }else{
                    if(auth()->user()->profile){
                        $this->memberRepo->updateProfile(auth()->user()->id,$request->validated());
                    }else{
                        $data['user_id'] = auth()->user()->id;
                        $this->memberRepo->createProfile($data);
                    }
                }
                return redirect(route('contact-information.create'))->with('success', 'Profile saved successfully!');
        }catch(\Exception $e){
            DB::rollback();
            if($e->getCode() == '23000'){
                return redirect()->back()->with('error', 'Duplicate entry not allowed');
            }
            return redirect()->back()->with('error', 'Error updating profile'.'error: '. $e->getMessage().', file: '. $e->getFile().', line: '. $e->getLine());
            Log::error('error: '. $e->getMessage().', file: '. $e->getFile().', line: '. $e->getLine());
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
            // if(empty(auth()->user()->profile)){
                $this->memberRepo->addAvatar(auth()->user()->profile->id, $avatar);
            // }else{
            //     return redirect()->back()->with('error', 'please upload profile before uploading avatar');
            // }
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
                'event_id' => $event['event_id'] ?? Null,
                'amount' => $amount,
                'reference' => $paymentDetails['data']['reference'],
                'remark' =>  $paymentDetails['data']['status']
            ]);
            // if($paymentDetails['data']['status'] == 'success'){
            //     $type = auth()->user()->memberType->id ?? '2';
            //     $this->memberRepo->updateUser(auth()->user()->id, ['status'=> 1, 'member_type_id' => $type ]);
            // }

        return redirect(route('dashboards'))->with('success', 'Transaction successful');
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }



    public function lga(Request $request){
        $this->memberRepo->findLga($request->state);
        return view('nhs.jpost.lga',compact('lgas'));
    }


    public function show(Request $request){
        $member = User::where(['type' => '2', 'id' => $request->id])->firstOrFail();
        $profile = optional($member->profile);
        return view('nhs.users.show', compact('member','profile'));
    }


    public function getLgas(Request $request){
        $lgas = Lga::select('name','id','state_id')->where('state_id', $request->state_id)->get();
        return json_encode($lgas);
    }


    public function eventTicket(Request $request){
        $event_payment = Payment::with('event')->where('event_id', $request->event_id)->firstOrFail();
        return view('users.event_ticket', compact('event_payment'));
    }


}
