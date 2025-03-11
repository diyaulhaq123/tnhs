<?php
namespace App\Repositories\Payment;

use App\Models\Payment;


class PaymentRepository implements PaymentRepositoryInterface{

    public function getPaymentsByStatus($remark){
        return Payment::with('user','event')->where('remark', $remark)->get();
    }

    public function list(){
        return Payment::with('user','event')->get();
    }

    public function eventPayList($id){
        return Payment::with('user','event')->where('payment_type_id', 2)
        ->where('event_id',$id)->get();
    }

    public function payEvent(array $data){
        return Payment::create($data);
    }

    public function updateEventPayment($ref,$remark){
        return Payment::where('reference', $ref)->update(['remark', $remark]);
    }

    public function PayMembership($user_id, $payment_type_id, $amount, $reference){
        return Payment::create([
            'user_id' => $user_id,
            'payment_type_id' => $payment_type_id,
            'amount' => $amount,
            'reference' => $reference
        ]);
    }

    public function updateMembershipPayment($ref,$remark){
        return Payment::where('reference', $ref)->update(['remark', $remark]);
    }

    public function getPayments(){
        return Payment::with('user','event')->orderBy('id', 'desc')->get();
    }

}
