<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::get();
        return view('nhs.notifications.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nhs.notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNotificationRequest $request)
    {
        $data = $request->validated();
        try{
            DB::beginTransaction();
            DB::commit();
            Notification::create($data);
            return redirect()->back()->with('success', 'Notification was created');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'An error occured');
            Log::error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        return view('nhs.notifications.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        return view('nhs.notifications.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        $data = $request->validated();
        try{
            DB::beginTransaction();
            DB::commit();
            $notification->update($data);
            return redirect()->back()->with('success', 'Notification was updated');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'An error occured');
            Log::error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        try{
            $notification->delete();
            return redirect()->back()->with('success', 'Notification was deleted');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'An error occured');
            Log::error($e->getMessage());
        }
    }
}
