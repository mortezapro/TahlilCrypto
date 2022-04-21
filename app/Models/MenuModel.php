<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    use HasFactory;
    protected $table = "menus";
    protected $primaryKey = "id";
    protected $fillable = [
        "title","link","parent_id","order"
    ];

    public function parent()
    {
        return $this->belongsTo(MenuModel::class,"parent_id");
    }
    public function child()
    {
        return $this->hasMany(MenuModel::class,"parent_id");
    }
}
