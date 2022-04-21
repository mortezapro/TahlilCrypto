<?php

namespace App\Repositories\Role;

use App\Models\RoleModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface{

    public Model $model;
    public function __construct( RoleModel $model)
    {
        $this->model = $model;
    }

}
