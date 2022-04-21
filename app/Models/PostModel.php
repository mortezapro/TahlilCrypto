<?php

namespace App\Models;

use App\Traits\Categorizable;
use App\Traits\Commentable;
use App\Traits\Galleriable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasActivity;

class PostModel extends Model
{
    use HasFactory,Categorizable,Commentable,Galleriable,HasActivity;

    protected $table = "posts";
    protected $primaryKey='id';
    protected $fillable = [
        "title","slug","description","seo_title","seo_description","seo_image","content","status","user_id","indexable","canonical","is_special","thumbnail","highlight"
    ];

    protected $casts = [
        'indexable' => 'boolean',
        'is_special' => 'boolean',
        'highlight' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }

    protected static function booted()
    {
        static::addGlobalScope('relation', function (Builder $builder) {
            $builder->with("user")->with("categories")->with("galleries")->with("comments")->orderBy("id","desc");
        });
    }

    public function setContentAttribute($value)
    {
        $this->attributes["content"] = htmlspecialchars($value);
    }

    public function getContentAttribute($value)
    {
        return html_entity_decode($value);
    }

    public function setIndexableAttribute($value): bool
    {
        return $this->attributes['indexable'] = !!$value;
    }

    public function getIndexableAttribute($value):string
    {
        if($value){
            return "yes";
        } else {
            return "no";
        }
    }

    public function setHighlightAttribute($value): bool
    {
        return $this->attributes['highlight'] = !!$value;
    }

    public function getHighLightAttribute($value):string
    {
        if($value){
            return "yes";
        } else {
            return "no";
        }
    }

    public function getStatusAttribute($value)
    {
        if($value == config("post-status.initialRegistration")){
            return "initialRegistration";
        } else if($value == config("post-status.disabled")){
            return "disabled";
        } else if($value == config("post-status.published")) {
            return "published";
        }
    }
    public function setIsSpecialAttribute($value): bool
    {
        return $this->attributes['is_special'] = !!$value;

    }
    public function getIsSpecialAttribute($value): string
    {
        if($value){
            return "yes";
        } else {
            return "no";
        }
    }

}
