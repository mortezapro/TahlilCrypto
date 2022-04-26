<?php

namespace App\Services\Permission;

use App\Helpers\ArrayClass;
use App\Models\PermissionModel;
use App\Models\RoleModel;
use App\Models\User;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Illuminate\Support\Facades\App;

class PermissionService{

    public PermissionRepositoryInterface $permissionRepository;

    public function __construct()
    {
        $this->permissionRepository = App::make(PermissionRepositoryInterface::class);
    }

    public function get(array $condition)
    {
        return $this->permissionRepository->get($condition);
    }

    public function paginate(int $paginate)
    {
        return $this->permissionRepository->paginate($paginate);
    }

    public function save(array $permission,int $id = null)
    {
        return $this->permissionRepository->save($permission,$id);
    }

    public function update(array $permission,int $id)
    {
        return $this->permissionRepository->save($permission,$id);
    }

    public function delete(PermissionModel $permission)
    {
        return $permission->delete();
    }

    public function getAllPermissions(... $permissions)
    {
        return $this->permissionRepository->getAllPermissions($permissions);
    }

    public function assignToUser(array $permissions,User $user)
    {
        return $user->givePermissionsToUser($permissions);
    }

    public function assignToRole(array $permissions, RoleModel $role)
    {
        return $role->givePermissionsToRole($permissions);
    }

    public function refreshUser(array $permissions,User $user)
    {
        return $user->refreshPermissionsOfUsers($permissions);
    }
    public function refreshRole(array $permissions,RoleModel $role)
    {
        return $role->refreshPermissionsOfRoles($permissions);
    }
}
