<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityModel extends Model
{
    use HasFactory;
    protected $table = "activity";
    protected $primaryKey = "id";
    protected $fillable = [
        "record_id","subject","user_id","table_name","method","ip_address","user_agent","url"
    ];

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }

    protected static function booted()
    {
        static::addGlobalScope('relation', function (Builder $builder) {
            $builder->with("user")->orderBy("id","desc");
        });
    }
}
