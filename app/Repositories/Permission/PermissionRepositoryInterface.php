<?php

namespace App\Repositories\Permission;

use App\Repositories\Base\BaseRepositoryInterface;

interface PermissionRepositoryInterface extends BaseRepositoryInterface {
    public function getAllPermissions(...$permissions);
}
