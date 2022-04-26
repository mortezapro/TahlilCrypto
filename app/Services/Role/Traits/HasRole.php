<?php

namespace App\Services\Role\Traits;

use App\Models\RoleModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRole{

    public function roles():BelongsToMany
    {
        return $this->belongsToMany(RoleModel::class,"role_user","user_id","role_id");
    }

    public function giveRolesTo(...$roles)
    {
        $roles =  $this->getAllRoles($roles);
        if($roles->isEmpty()){
            return $this;
        }
        $this->roles()->syncWithoutDetaching($roles);
        return $this;
    }

    protected function getAllRoles(array $roles)
    {
        return RoleModel::whereIn("name",$this->array_flatten($roles))->get();
    }
    public function withdrawRoles(...$roles)
    {
        $roles =  $this->getAllRoles($roles);
        $this->roles()->detach($roles);
        return $this;
    }
    public function droppedRoles(RoleModel $role)
    {
        $this->roles()->detach($role);
        return $this;
    }
    public function array_flatten(array $array)
    {
        $result = array();
        foreach($array as $key => $value) {
            if (is_array($value)) {
                $result = $result + $this->array_flatten($value);
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    public function refreshRoles(...$roles)
    {
        $roles =  $this->getAllRoles($roles);
        $this->roles()->sync($roles);
        return $this;
    }
    public function hasRoles(string $role)
    {
        return $this->roles->contains("name",$role);
    }
}
