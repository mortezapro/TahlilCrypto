<?php

namespace App\Repositories\Theme;

use App\Models\ThemeModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ThemeRepository extends BaseRepository implements ThemeRepositoryInterface{

    public Model $model;
    public function __construct( ThemeModel $model)
    {
        $this->model = $model;
    }

}
