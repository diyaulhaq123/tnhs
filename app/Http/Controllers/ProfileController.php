<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Lga;
use App\Models\State;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\MembershipCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{



    public function consent()
    {
        return view('profile.consent');
    }

    public function completeProfile(Request $request){
        $data = $request->validate(['consent' => 'required|boolean']);
        $user = auth()->user();
        // if($request->user()->profile && $request->user()->profile->status == 1){
        // }
        try{
            DB::beginTransaction();
            DB::commit();
            $user->update(['completed_profile' => 1]);
            return redirect()->route('dashboards')->with('success', 'Profile completed!');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error completing profile');
            Log::error($e->getMessage());
        }
    }


    public function index(Request $request){
        $profile = auth()->user()->profile;
        $states = State::get();
        $lgas = Lga::get();
        return view('nhs.profile',compact('profile','states','lgas'));
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

    public function create(){
        $profile = auth()->user()->profile;
        $states = State::get();
        $lgas = Lga::get();
        $membershipCategories = MembershipCategory::get();
        return view('profile.create', compact('profile','states','lgas','membershipCategories'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    public function update(UpdateProfileRequest $request){
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
                return redirect()->back()->with('success', 'Profile updated!');
        }catch(Exception $e){
            DB::rollback();
            if($e->getCode() == '23000'){
                return redirect()->back()->with('error', 'Duplicate entry not allowed');
            }
            return redirect()->back()->with('error', 'Error updating profile'.'error: '. $e->getMessage().', file: '. $e->getFile().', line: '. $e->getLine());
            Log::error('error: '. $e->getMessage().', file: '. $e->getFile().', line: '. $e->getLine());
        }
    }



    public function store(CreateProfileRequest $request){
        $data = $request->validated();
        try{
                DB::beginTransaction();
                DB::commit();
                $this->memberRepo->createProfile($data);
                return redirect()->route('dashboards')->with('success', 'Profile saved!');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Error Saving profile');
            Log::error($e->getMessage());
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
