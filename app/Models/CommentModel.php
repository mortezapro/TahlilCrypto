<?php

namespace App\Models;

use App\Traits\HasActivity;
use App\Traits\Commentable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CommentModel extends Model
{
    use HasFactory,HasActivity,Commentable;
    protected $table = "comments";
    protected $primaryKey = "id";
    protected $fillable = [
        "user_id","content","reply_id","status"
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return  $this->belongsTo(User::class,"user_id");
    }

    protected static function booted()
    {
        static::addGlobalScope('relation', function (Builder $builder) {
            $builder->with("user")->with("commentable")->with("reply")->orderBy("id","desc");
        });
    }

    public function getStatusAttribute($value)
    {
        if($value == config("comment-status.initialRegistration")){
            return "initialRegistration";
        } else if($value == config("comment-status.disabled")){
            return "disabled";
        } else if($value == config("comment-status.published")) {
            return "published";
        }
    }

    public function reply()
    {
        return $this->hasMany(CommentModel::class,"reply_id")->where("status",config("comment-status.published"));
    }
}
