<?php

namespace App\Repositories\Video;

use App\Models\PostModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class VideoRepository extends BaseRepository implements VideoRepositoryInterface {

    public Model $model;
    public function __construct(PostModel $model)
    {
        $this->model = $model;
    }

}
