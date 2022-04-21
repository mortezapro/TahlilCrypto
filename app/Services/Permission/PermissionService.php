<?php

namespace App\Services\Permission;

use App\Models\PermissionModel;
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

    public function save(array $post,int $id = null)
    {
        return $this->permissionRepository->save($post,$id);
    }

    public function update(array $post,string $slug)
    {
        return $this->permissionRepository->save($post,$slug);
    }

    public function delete(PermissionModel $permission)
    {
        return $permission->delete();
    }

}
