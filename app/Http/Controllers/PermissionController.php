<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Models\PermissionModel;
use App\Services\Permission\PermissionService;
use Illuminate\Support\Facades\App;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{

    public PermissionService $permissionService;

    public function __construct()
    {
        $this->permissionService = App::make(PermissionService::class);
    }

    public function index()
    {
        $permissions = $this->permissionService->paginate(10);
        return view("panel.permissions.index",compact("permissions"));
    }

    public function create()
    {
        return view("panel.permissions.new");
    }

    public function edit(PermissionModel $permission)
    {
        return view("panel.permissions.edit",compact("permission"));
    }

    public function store(PermissionRequest $request, PermissionModel $permission = null)
    {
        $permissionData = $request->all();

        $permission ? $this->permissionService->save($permissionData,$permission->id) : $permission = $this->permissionService->save($permissionData);

        // there is a situation that permission has not changed, but gallery request changed. this situation PermissionObserver has not performed updated method.
        // so, we should check gallery request in the controller.
        // if request has any gallery then upload it and save to db and sync galleriables
        // and also category request

        if($permission){
            return redirect()->route('admin.permissions.index')->with('save',true);
        }
        return abort(500);
    }

    public function destroy(PermissionModel $permission)
    {
        if( $this->permissionService->delete($permission) ){
            return redirect()->route("admin.permissions.index")->with("delete",true);
        }
    }

}
