<?php

namespace App\Models;

use App\Traits\Categorizable;
use App\Traits\Commentable;
use App\Traits\Galleriable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoModel extends Model
{
    use HasFactory,Categorizable,Galleriable,Commentable;
    protected $table = "videos";
    protected $primaryKey = "id";
    protected $fillable = [
        "title","slug","thumbnail","content","indexable","highlight","video_url","canonical","seo_title","seo_description","seo_image","user_id"
    ];
    protected $casts = [
        'indexable' => 'boolean',
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

    public function getHighlightAttribute($value):string
    {
        if($value){
            return "yes";
        } else {
            return "no";
        }
    }
}
