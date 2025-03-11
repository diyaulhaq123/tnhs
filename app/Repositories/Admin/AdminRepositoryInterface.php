<?php
namespace App\Repositories\Admin;

interface AdminRepositoryInterface{


    public function createRole($name);

    public function createPermission($name);

    public function getRoles();

    public function getPermissions();

    public function getRolesPermissions();
    public function assignPermission($role, $permission);
    public function getRolePermissions($role);
    public function assignRoleToUser($id, $role);
    public function changePassword($id,$password);

}
