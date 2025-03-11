<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Event;
use App\Models\MemberType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\EventNotification;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Notification;
use App\Repositories\Admin\AdminRepositoryInterface;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Member\MemberRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;

class AdminController extends Controller
{

    private $eventRepo;
    private $adminRepo;
    private $payRepo;

    public function __construct(EventRepositoryInterface $eventRepo, AdminRepositoryInterface $adminRepo,
                    MemberRepositoryInterface $memberRepo, PaymentRepositoryInterface $payRepo){
        $this->eventRepo = $eventRepo;
        $this->adminRepo = $adminRepo;
        $this->memberRepo = $memberRepo;
        $this->payRepo = $payRepo;
    }



    public function  role(){
        $permissions = $this->adminRepo->getPermissions();
        $roles = $this->adminRepo->getRoles();
        return view('nhs.admin.roles', compact('roles','permissions'));
    }


    public function  permissions(){
        $roles = $this->adminRepo->getRoles();
        $permissions = $this->adminRepo->getPermissions();
        $users = $this->memberRepo->getUsers();
        return view('nhs.admin.permissions', compact('users','roles','permissions'));
    }

    public function assignPermission(Request $request){
        // $request->validate(['role' => 'required', 'permission' => 'required']);
        // try{
        //     DB::beginTransaction();
        //     DB::commit();
        //     $this->adminRepo->assignPermission($request->role, $request->permission);
        //     return redirect()->back()->with('success', 'Permission assigned');
        // }catch(\Exception $e){
        //     DB::rollback();
        //     return redirect()->back()->with('error', 'Permission not assigned');
        //     Log::error($e->getMessage());
        // }
        foreach ($request->permissions as $roleId => $permissions) {
            $role = Role::find($roleId);
            if ($role) {
                $role->syncPermissions($permissions);
            }
        }
        return redirect()->back()
            ->with('success', 'Permissions updated successfully.');
    }

    public function assignRoleToUser(Request $request){
        $request->validate(['role_id' => 'required', 'user_id' => 'required'],
            ['role_id.required' => 'role is required', 'user_id.required' => 'user is required']
        );
        try{
            DB::beginTransaction();
            DB::commit();
            $this->adminRepo->assignRoleToUser($request->user_id, $request->role_id);
            return redirect()->back()->with('success', 'Role assigned');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Role not assigned');
            Log::error($e->getMessage());
        }
    }

    public function createRole(Request $request){
        $request->validate(['name' => 'required']);
        try{
            DB::beginTransaction();
            DB::commit();
            $this->adminRepo->createRole($request->name);
            return redirect()->back()->with('success', 'Role added');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Role not added');
            Log::error($e->getMessage());
        }
    }

    public function createPermission(Request $request){
        $request->validate(['name' => 'required']);
        try{
            DB::beginTransaction();
            DB::commit();
            $this->adminRepo->createPermission($request->name);
            return redirect()->back()->with('success', 'Permission added');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Permission not added');
            Log::error($e->getMessage());
        }
    }

    public function dashboard(){
        $users = $this->memberRepo->getUsers();
        $active_users = $this->memberRepo->getByStatus(1);
        $in_active = $this->memberRepo->getByStatus(0);
        $events =  $this->eventRepo->get();
        $done_events =  $this->eventRepo->getByStatus('done');
        $pendings = $this->eventRepo->getByStatus('pending');
        $total_payments = $this->payRepo->getPaymentsByStatus('success')->sum('amount');
        $payments = $this->payRepo->getPaymentsByStatus('success');
        $pending_payments = $this->payRepo->getPaymentsByStatus('pending')->sum('amount');
        $success_payments = $this->payRepo->getPaymentsByStatus('success')->sum('amount');
        return view('nhs.admin.dashboard',compact('users','active_users','in_active','done_events','pendings','events',
        'total_payments','payments','pending_payments','success_payments'));
    }

    public function profile(Request $request){
        $profile = auth()->user()->profile;
        return view('nhs.profile',compact('profile'));
    }

    public function changePassword(Request $request){
        $request->validate(['old_password'=>'required', 'password' => 'required|min:8|confirmed']);
        try{
            if(Auth::check() && Hash::check($request->password, Auth::user()->password)){
                DB::beginTransaction();
                DB::commit();
                $this->adminRepo->changePassword($request->id,$request->password);
                return redirect()->back()->with('success', 'Password changed');
            }
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error changing password');
            Log::error($e->getMessage());
        }
    }

    public function event(){
        $this->eventRepo->updateEvent();
        $done_events =  $this->eventRepo->getByStatus('done');
        $pendings = $this->eventRepo->getByStatus('pending');
        // $check_event_payment =
        $member_types = $this->memberRepo->getMemberTypes();
        return view('nhs.admin.events', compact('done_events','pendings','member_types'));
    }

    public function pastEvent(){
        $this->eventRepo->updateEvent();
        $done_events =  $this->eventRepo->getByStatus('done');
        $pendings = $this->eventRepo->getByStatus('pending');
        // $check_event_payment =
        return view('nhs.admin.past_events', compact('done_events','pendings'));
    }

    public function createEvent(CreateEventRequest $request){
        $data = $request->validated();
        try{
            DB::beginTransaction();
            DB::commit();
            $this->eventRepo->create($data);
            return redirect()->back()->with('success', 'Even was added');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'An error occured');
            Log::error($e->getMessage());
        }
    }

    public function edit(Request $request){
        $member_types = MemberType::get();
        $event = Event::where('id', $request->id)->first();
        return view('nhs.event.edit', compact('event','member_types'));
    }

    public function updateEvent(UpdateEventRequest $request){
        $data = $request->validated();
        try{
            DB::beginTransaction();
            DB::commit();
            Event::where('id', $request->id)->update($data);
            return redirect()->back()->with('success', 'Even was updated');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'An error occured');
            Log::error($e->getMessage());
        }
    }

    public function sendNotification(Request $request){
        $request->validate(['message' => 'required']);
        $recepients = $this->memberRepo->getMembers();
        $message = $request->message;
        try{
            Notification::send($recepients, new EventNotification($message));
        return redirect()->back()->with('success', 'Notification was sent');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Notification was not sent');
            Log::error($e->getMessage());
        }
    }

    public function eventPaymentList(Request $request){

        $lists = $this->payRepo->eventPayList($request->id);
        return view('nhs.admin.event_payment_list', compact('lists'));
    }

    public function users(Request $request){

        $lists = $this->memberRepo->getMembers();
        return view('nhs.admin.user_list', compact('lists'));
    }

    public function deleteUser(Request $request){
        try{
            $this->memberRepo->deleteUser($request->id);
            return redirect()->back()->with('success', 'Member profile deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Could not delete');
            Log::error($e->getMessage());
        }
    }

    public function reminder(){
        return view('nhs.admin.reminder');
    }

    public function payment(){
        $payments = $this->payRepo->getPayments();
        return view('nhs.admin.payments', compact('payments'));
    }




}
