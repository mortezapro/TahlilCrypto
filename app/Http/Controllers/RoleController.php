<?php

namespace App\Http\Controllers;

use App\Helpers\DataTable;
use App\Models\PermissionModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Services\Role\RoleService;
use Illuminate\Support\Facades\App;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Cache;

class RoleController extends Controller
{

    public RoleService $roleService;

    public function __construct()
    {
        $this->roleService = App::make(RoleService::class);
    }

    public function index(Request $request)
    {
        $roles = $this->roleService->paginate(10);
        return view("panel.roles.index",compact("roles"));
    }

    public function create()
    {
        return view("panel.roles.new");
    }

    public function edit(RoleModel $role)
    {
        return view("panel.roles.edit",compact("role"));
    }

    public function store(RoleRequest $request, RoleModel $role = null)
    {
        $roleData = $request->all();

        $role ? $this->roleService->save($roleData,$role->id) : $role = $this->roleService->save($roleData);

        // there is a situation that role has not changed, but gallery request changed. this situation RoleObserver has not performed updated method.
        // so, we should check gallery request in the controller.
        // if request has any gallery then upload it and save to db and sync galleriables
        // and also category request

        if($role){
            return redirect()->route('admin.roles.index')->with('save',true);
        }
        return abort(500);
    }

    public function destroy(RoleModel $role)
    {
        if( $this->roleService->delete($role) ){
            return redirect()->route("admin.roles.index")->with("delete",true);
        }
    }

    public function assignToUser(Request $request,User $user)
    {
        return $this->roleService->assignToUser($user,$request->input("roles"));
    }

    public function refreshRoles(Request $request,User $user)
    {
        return $this->roleService->refreshRoles($user,$request->input("roles"));
    }

}
