<?php

namespace App\Services\Role;

use App\Models\RoleModel;
use App\Models\User;
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

    public function save(array $role,int $id = null)
    {
        return $this->roleRepository->save($role,$id);
    }

    public function update(array $role,int $id)
    {
        return $this->roleRepository->save($role,$id);
    }

    public function delete(RoleModel $role)
    {
        return $role->delete();
    }

    public function assignToUser(User $user,array $roles)
    {
        $user->giveRolesTo($roles);
    }

    public function refreshRoles(User $user,array $roles = null)
    {

        $user->refreshRoles($roles);
    }

}
