<?php

namespace App\Models;

use App\Services\Permission\Traits\HasPermission;
use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory,HasActivity,HasPermission;
    protected $table = "roles";
    protected $primaryKey = "id";
    protected $fillable = [
        "name","display_name"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,"role_user","role_id","user_id");
    }

}
