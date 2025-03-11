<?php
namespace App\Repositories\Payment;


 interface PaymentRepositoryInterface{


    public function getPaymentsByStatus($remark);
    public function list();

    public function eventPayList($id);

    public function payEvent(array $data);
    public function updateEventPayment($ref,$remark);
    public function PayMembership($user_id, $payment_type_id, $amount, $reference);
    public function updateMembershipPayment($ref,$remark);
    public function getPayments();
}


