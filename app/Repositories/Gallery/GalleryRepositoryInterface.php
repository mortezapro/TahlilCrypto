<?php

namespace App\Repositories\Gallery;

use App\Repositories\Base\BaseRepositoryInterface;

interface GalleryRepositoryInterface extends BaseRepositoryInterface{
    public function getGalleryByObject(Object $object,string $relation,string $galleriableType);
}
