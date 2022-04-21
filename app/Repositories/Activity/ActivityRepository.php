<?php

namespace App\Repositories\Activity;

use App\Models\ActivityModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ActivityRepository extends BaseRepository implements ActivityRepositoryInterface {
    public Model $model;
    public function __construct(ActivityModel $model)
    {
        $this->model = $model;
    }
}
