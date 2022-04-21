<?php

namespace App\Repositories\Permission;

use App\Models\PermissionModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface{

    public Model $model;
    public function __construct( PermissionModel $model)
    {
        $this->model = $model;
    }

}
