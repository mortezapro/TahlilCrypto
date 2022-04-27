<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Permission\PermissionService;
use Illuminate\Support\Facades\Request;
use App\Models\UserModel;
use App\Services\User\UserService;
use Illuminate\Support\Facades\App;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    public UserService $userService;
    public PermissionService $permissionService;

    public function __construct()
    {
        $this->userService = App::make(UserService::class);
        $this->permissionService = App::make(PermissionService::class);
    }

    public function index()
    {
        $users = $this->userService->paginate(10);
        return view("panel.users.index",compact("users"));
    }


    public function edit(UserModel $user)
    {
        return view("panel.users.edit",compact("user"));
    }


}
