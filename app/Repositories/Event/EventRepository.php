<?php
namespace App\Repositories\Event;

use App\Models\Event;
use App\Models\Payment;

class EventRepository implements EventRepositoryInterface{

    public function get(){
        return Event::with('memberType')->get();
    }

    public function getByType($type){
        return Event::with('memberType')->where('member_type_id', $type)->get();
    }

    public function getByStatus($status){
        return Event::with('memberType')->where('status', $status)->orderBy('id', 'desc')->get();
    }

    public function find($id){
        return Event::with('memberType')->firstOrFail($id);
    }

    public function delete($id){
        $event = Event::firstOrFail($id);
        return $event->delete();
    }

    public function update($id, array $event){
        $event = Event::firstOrFail($id);
        return $event->update($event);
    }

    public function create(array $event){
        return Event::create($event);
    }

    public function checkEventPayment($event_id,$user_id){
        return Payment::where('event_id', $event_id)->where('payment_type_id', 2)
        ->where('remark', 'success')->where('user_id', $user_id)->first();
    }

    public function getPaymentsForEvent($user_id,$event_id){
        return Payment::with('memberType','user','event')->where('user_id', $user_id)
        ->where('event_id', $event_id)->get();
    }

    public function eventPayList(){
        return Payment::with('memberType','user','event')->where('payment_type_id', 2)->get();
    }

    public function updateEvent(){
        $date = date('Y-m-d');
        return Event::where('date', '<', $date)->update(['status' => 'done']);
    }


}
