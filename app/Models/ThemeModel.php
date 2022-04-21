<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeModel extends Model
{
    use HasFactory;
    protected $table = "themes";
    protected $primaryKey = "id";
    protected $fillable = [
        "name","layout_path","image","description"
    ];
}
