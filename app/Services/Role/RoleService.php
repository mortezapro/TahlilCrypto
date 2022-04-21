<?php

namespace App\Services\Role;

use App\Models\RoleModel;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Support\Facades\App;

class RoleService{

    public RoleRepositoryInterface $roleRepository;

    public function __construct()
    {
        $this->roleRepository = App::make(RoleRepositoryInterface::class);
    }

    public function get(array $condition)
    {
        return $this->roleRepository->get($condition);
    }

    public function paginate(int $paginate)
    {
        return $this->roleRepository->paginate($paginate);
    }

    public function save(array $post,int $id = null)
    {
        return $this->roleRepository->save($post,$id);
    }

    public function update(array $post,string $slug)
    {
        return $this->roleRepository->save($post,$slug);
    }

    public function delete(RoleModel $role)
    {
        return $role->delete();
    }

}
