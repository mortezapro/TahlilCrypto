<?php

namespace App\Repositories\Menu;

use App\Models\MenuModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface{

    public Model $model;
    public function __construct( MenuModel $model)
    {
        $this->model = $model;
    }
}
