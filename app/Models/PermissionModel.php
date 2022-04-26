<?php

namespace App\Models;

use App\Services\Role\Traits\HasRole;
use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{
    use HasFactory,HasActivity,HasRole;
    protected $table = "permissions";
    protected $primaryKey = "id";
    protected $fillable = ["name","display_name"];

    public function roles()
    {
        return $this->belongsToMany(RoleModel::class,"permission_role","permission_id","role_id");
    }
}
