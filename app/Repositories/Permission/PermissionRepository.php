<?php

namespace App\Repositories\Permission;

use App\Helpers\ArrayClass;
use App\Models\PermissionModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface{

    public Model $model;
    public function __construct( PermissionModel $model)
    {
        $this->model = $model;
    }

    public function getAllPermissions(...$permissions)
    {
        $this->generateCacheKey(__FUNCTION__);
        return Cache::remember($this->cacheKey,$this->cacheDuration , function () use ($permissions) {
            return $this->model->whereIn("name",ArrayClass::flatten($permissions))->get();
        });
    }
}
