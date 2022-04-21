<?php

namespace App\Traits;

use App\Models\GalleryModel;

trait Galleriable{
    public function galleries()
    {
        return $this->morphToMany(GalleryModel::class,'galleriable');
    }
    public function galleryReverse()
    {
        return $this->morphedByMany(GalleryModel::class,'galleriable');
    }
}
