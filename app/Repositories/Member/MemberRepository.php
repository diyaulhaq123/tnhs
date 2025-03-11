<?php
namespace App\Repositories\Member;

use App\Models\Lga;
use App\Models\User;
use App\Models\State;
use App\Models\Profile;
use App\Models\MemberType;
use App\Http\Controllers\Member\Member;

class MemberRepository implements MemberRepositoryInterface{


    public function getUsers(){
        return User::with('profile','memberType')->get();
    }

    public function getMembers(){
        return User::with('profile','memberType')->where('type', '!=', 1)->get();
    }

    public function getByStatus($status){
        return User::with('profile','memberType')->where('status', $status)->get();
    }

    public function updateMember($id, array $member){
        $member = Member::firstOrFail($id);
        return $member->update($member);
    }

    public function createMember(array $member){
        return Member::create($member);
    }

    public function findUser($id){
        return User::with('profile')->firstOrFail($id);
    }

    public function deleteUser($id){
        $user = User::where('id', $id)->firstOrFail();
        return $user->delete();
    }

    public function updateUser($id, array $user){
        return User::where('id', $id)->update($user);
    }

    public function getMemberTypes(){
        return MemberType::where('status', 1)->get();
    }

    public function states(){
        return State::get();
        // return 'hello';
    }

    public function lgas(){
        return Lga::get();
    }

    public function findLga($id){
        return Lga::where('state_id', $id)->get();
    }

    public function updateProfile($id, array $member){
        $data = Profile::where('user_id', $id)->firstOrFail();
        return $data->update($member);
    }

    public function createProfile(array $member){
        return Profile::create($member);
    }


    public function addAvatar($id, $avatar){
        return Profile::where('id', $id)->update(['avatar' => $avatar]);
    }



}
