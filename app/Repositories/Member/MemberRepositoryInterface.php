<?php
namespace App\Repositories\Member;

interface MemberRepositoryInterface{


    public function getUsers();

    public function getMembers();
    public function getByStatus($status);

    public function updateMember($id, array $member);
    public function createMember(array $member);
    public function findUser($id);
    public function deleteUser($id);
    public function updateUser($id, array $user);

    public function getMemberTypes();

    public function states();

    public function lgas();

    public function findLga($id);
    public function addAvatar($id, $avatar);

}
