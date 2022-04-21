<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\App;

class UserService{

    public UserRepositoryInterface $userRepository;

    public function __construct()
    {
        $this->userRepository = App::make(UserRepositoryInterface::class);
    }

    public function get(array $condition)
    {
        return $this->userRepository->get($condition);
    }

    public function paginate(int $paginate)
    {
        return $this->userRepository->paginate($paginate);
    }

    public function save(array $post,int $id = null)
    {
        return $this->userRepository->save($post,$id);
    }

    public function update(array $post,string $slug)
    {
        return $this->userRepository->save($post,$slug);
    }

    public function delete(User $user)
    {
        return $user->delete();
    }

}
