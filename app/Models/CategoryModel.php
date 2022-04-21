<?php

namespace App\Models;

use App\Traits\HasActivity;
use App\Traits\Categorizable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory,HasActivity,Categorizable;
    protected $table="category";
    protected $primaryKey="id";
    protected $fillable = [
        "title","slug","seo_description","seo_title","canonical","user_id","indexable","is_special","seo_image","thumbnail"
    ];

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }

    protected static function booted()
    {
        static::addGlobalScope('relation', function (Builder $builder) {
            $builder->with("categoriesReverse")->with("categories")->orderBy("id","desc");
        });
    }

    public function posts()
    {
        return $this->morphedByMany(PostModel::class,"categorizable","categorizables");
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
}
