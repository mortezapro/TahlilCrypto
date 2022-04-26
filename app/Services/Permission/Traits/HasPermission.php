<?php

namespace App\Services\Permission\Traits;

use App\Models\PermissionModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermission{
    public function permissions():BelongsToMany
    {
        return $this->belongsToMany(PermissionModel::class,"permission_role","role_id","permission_id");
    }

    public function permissionUsers():BelongsToMany
    {
        return $this->belongsToMany(PermissionModel::class,"permission_user","user_id","permission_id");
    }

    public function givePermissionsToRole(...$permissions)
    {
        $permissions =  $this->getAllPermissions($permissions);
        if($permissions->isEmpty()){
            return $this;
        }
        $this->permissions()->syncWithoutDetaching($permissions);
        return $this;
    }

    public function givePermissionsToUser(...$permissions)
    {
        $permissions =  $this->getAllPermissions($permissions);
        if($permissions->isEmpty()){
            return $this;
        }
        $this->permissionUsers()->syncWithoutDetaching($permissions);
        return $this;
    }

    public function getAllPermissions(array $permissions)
    {
        return PermissionModel::whereIn("name",$this->arrayFlatten($permissions))->get();
    }

    public function withdrawPermissions(...$permissions)
    {
        $permissions =  $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function refreshPermissionsOfRoles(...$permissions)
    {
        $permissions =  $this->getAllPermissions($permissions);
        $this->permissions()->sync($permissions);
        return $this;
    }

    public function refreshPermissionsOfUsers(...$permissions)
    {
        $permissions =  $this->getAllPermissions($permissions);
        $this->permissionUsers()->sync($permissions);
        return $this;
    }

    public function arrayFlatten(array $array)
    {
        $result = array();
        foreach($array as $key => $value) {
            if (is_array($value)) {
                $result = $result + $this->arrayFlatten($value);
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }
    public function userHasPermissions(PermissionModel $permission)
    {
        return $this->hasPermissionsThroughRole($permission) || $this->permissions->contains($permission);
    }
    public function hasPermissions(PermissionModel $permission)
    {
        return $this->permissions->contains($permission);
    }
    protected function hasPermissionsThroughRole(PermissionModel $permission)
    {
        foreach ($permission->roles as $role) {
            if($this->roles->contains($role)){
                return true;
            }
            return false;
        }

    }
}
