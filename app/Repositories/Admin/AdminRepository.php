<?php
namespace App\Repositories\Admin;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AdminRepository implements AdminRepositoryInterface{

    public function createRole($name){
        return $role = Role::create(['name' => $name]);
    }

    public function createPermission($name){
        return $permission = Permission::create(['name' => $name]);
    }

    public function getRoles(){
        return $role = Role::with('permissions')->get();
    }

    public function getPermissions(){
        return $role = Permission::get();
    }

    public function getRolesPermissions(){
        // return ModelHasPermissions::get();
    }

    public function assignPermission($role, $permission){
        $role = Role::where('name', $role)->first(); // Find the role
        $permission = Permission::where('name', $permission)->first();
        if ($role && $permission) {
            return $role->givePermissionTo($permission); // Assign permission to the role
        }
        return false;
    }

    public function getRolePermissions($role){
        return Permission::role($role)->get();
    }

    public function assignRoleToUser($id, $role){
        $user = User::find($id);
        return $user->assignRole($role);
    }

    public function changePassword($id,$password){
        return User::where('id', $id)->update(['password'=> Hash::make($password)]);
    }


}
