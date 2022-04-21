<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{
    use HasFactory,HasActivity;
    protected $table = "permissions";
    protected $primaryKey = "id";
    protected $guarded = "id";

    public function roles()
    {
        return $this->belongsToMany(RoleModel::class,"permission_role","permission_id","role_id");
    }
}
