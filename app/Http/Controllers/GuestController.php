<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;
use App\Repositories\Member\MemberRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;

class GuestController extends Controller
{

    public $memberRepo;
    public function __construct(MemberRepositoryInterface $memberRepo, PaymentRepositoryInterface $payRepo){
        $this->memberRepo = $memberRepo;
        $this->payRepo = $payRepo;
    }


    public function reciept(){
        return view('reciept');
    }


    public function membership(){
        $memberships = $this->memberRepo->getMemberTypes();
        return view('nhs.membership', compact('memberships'));
    }

    public function changeMembership(Request $request){
        $data = $request->validate(['type' => 'required|int']);
        try{
            DB::beginTransaction();
            DB::commit();
            $this->memberRepo->updateUser(auth()->user()->id, $data);
            return redirect()->back()->with('success', 'Membership plan changed');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Could not change membership');
            Log::error($e->getMessage());
        }
    }


    public function redirectToGateway(Request $request)
    {
        $data = $request->validate([
            'payment_type_id' => 'required',
            'amount' => 'required',
        ]);
        try {
            $metadata = [
                'payment_type_id' => 1,
            ];

            $authorizationUrl = Paystack::getAuthorizationUrl([
                'email' => $request->email,
                'amount' => $request->amount,
                'reference' => $request->reference,
                'metadata' => $metadata,
            ])->redirectNow();
            return $authorizationUrl;
        } catch (\Exception $e) {
            // Handle exceptions
            Log::error($e->getMessage());

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
        $pay_type = $paymentDetails['data']['metadata'];
        $this->payRepo->payEvent([
                'user_id' => auth()->user()->id,
                'payment_type_id' => $pay_type['payment_type_id'],
                'amount' => $amount,
                'reference' => $paymentDetails['data']['reference'],
                'remark' =>  $paymentDetails['data']['status'],
                'event_id' => Null
            ]);
            if($paymentDetails['data']['status'] == 'success'){
                $type = auth()->user()->memberType->id;
                $this->memberRepo->updateUser(auth()->user()->id, ['status'=> 1, 'type' => $type ]);
            }

        return redirect(route('dashboards'))->with('success', 'Payment successful');
    }



}
