<?php

namespace App\Repositories\Gallery;

use App\Models\GalleryModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class GalleryRepository extends BaseRepository implements GalleryRepositoryInterface{
    public Model $model;
    public function __construct(GalleryModel $model)
    {
        $this->model = $model;
    }

    public function getGalleryByObject(Object $object,string $relation,string $galleriableType)
    {
        return GalleryModel::with($relation)->whereHas($relation,function ($q) use ($object,$galleriableType){
            return $q->where("galleriable_id",$object->id)->where("galleriable_type",$galleriableType);
        })->get();
    }
}
