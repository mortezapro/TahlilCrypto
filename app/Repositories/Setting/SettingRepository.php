<?php

namespace App\Repositories\Setting;

use App\Models\SettingModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface{

    public Model $model;
    public function __construct( SettingModel $model)
    {
        $this->model = $model;
    }

}
