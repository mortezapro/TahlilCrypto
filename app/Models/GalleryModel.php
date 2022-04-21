<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryModel extends Model
{
    use HasFactory,HasActivity;
    protected $table = "galleries";
    protected $primaryKey='id';
    protected $fillable = [
        "path","extension"
    ];

    public function post()
    {
        return $this->morphedByMany(PostModel::class,'galleriable');
    }
    public function event()
    {
        return $this->morphedByMany(EventModel::class,'galleriable');
    }
    public function video()
    {
        return $this->morphedByMany(VideoModel::class,'galleriable');
    }
}
