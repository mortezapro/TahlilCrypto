<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Models\MenuModel;
use App\Services\Menu\MenuService;
use Illuminate\Support\Facades\App;
use App\Http\Requests\MenuRequest;

class MenuController extends Controller
{

    public MenuService $menuService;

    public function __construct()
    {
        $this->menuService = App::make(MenuService::class);
    }

    public function index()
    {
        $menus = $this->menuService->paginate(10);
        return view("panel.menus.index",compact("menus"));
    }

    public function create()
    {
        return view("panel.menus.new");
    }

    public function edit(MenuModel $menu)
    {
        return view("panel.menus.edit",compact("menu"));
    }

    public function store(MenuRequest $request, MenuModel $menu = null)
    {
        $menuData = $request->all();

        $menu ? $this->menuService->save($menuData,$menu->id) : $menu = $this->menuService->save($menuData);

        // there is a situation that menu has not changed, but gallery request changed. this situation MenuObserver has not performed updated method.
        // so, we should check gallery request in the controller.
        // if request has any gallery then upload it and save to db and sync galleriables
        // and also category request

        if($menu){
            return redirect()->route('admin.menus.index')->with('save',true);
        }
        return abort(500);
    }

    public function destroy(MenuModel $menu)
    {
        if( $this->menuService->delete($menu) ){
            return redirect()->route("admin.menus.index")->with("delete",true);
        }
    }

}
