<?php
namespace App\Repositories\Event;

interface EventRepositoryInterface{


    public function get();
    public function getByType($type);

    public function getByStatus($status);

    public function find($id);

    public function delete($id);

    public function update($id, array $event);

    public function create(array $event);
    public function checkEventPayment($event_id,$user_id);

    public function getPaymentsForEvent($user_id,$event_id);
    public function eventPayList();
    public function updateEvent();


}
