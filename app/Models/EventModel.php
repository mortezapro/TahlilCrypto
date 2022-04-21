<?php

namespace App\Models;

use App\Traits\Categorizable;
use App\Traits\Commentable;
use App\Traits\Galleriable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    use HasFactory,Categorizable,Galleriable,Commentable;
    protected $table = "events";
    protected $primaryKey = "id";
    protected $fillable = [
        "title","slug","thumbnail","content","indexable","highlight","event_date","canonical","seo_title","seo_description","seo_image"
    ];
    protected $casts = [
        'indexable' => 'boolean',
        'highlight' => 'boolean',
    ];

    protected static function booted()
    {
        static::addGlobalScope('relation', function (Builder $builder) {
            $builder->with("galleries")->with("categories")->with("comments")->orderBy("id","desc");
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
