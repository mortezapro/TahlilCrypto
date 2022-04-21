<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistoryModel extends Model
{
    use HasFactory;
    protected $table = "search_history";
    protected $primaryKey = "id";
    protected $fillable = [
        "search_text","count"
    ];
}
