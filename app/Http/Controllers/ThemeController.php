<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Models\ThemeModel;
use App\Services\Theme\ThemeService;
use Illuminate\Support\Facades\App;
use App\Http\Requests\ThemeRequest;

class ThemeController extends Controller
{

    public ThemeService $themeService;

    public function __construct()
    {
        $this->themeService = App::make(ThemeService::class);
    }

    public function index()
    {
        $themes = $this->themeService->paginate(10);
        return view("panel.themes.index",compact("themes"));
    }

    public function create()
    {
        return view("panel.themes.new");
    }

    public function edit(ThemeModel $theme)
    {
        return view("panel.themes.edit",compact("theme"));
    }

    public function store(ThemeRequest $request, ThemeModel $theme = null)
    {
        $themeData = $request->all();

        $theme ? $this->themeService->save($themeData,$theme->id) : $theme = $this->themeService->save($themeData);

        // there is a situation that theme has not changed, but gallery request changed. this situation ThemeObserver has not performed updated method.
        // so, we should check gallery request in the controller.
        // if request has any gallery then upload it and save to db and sync galleriables
        // and also category request

        if($theme){
            return redirect()->route('admin.themes.index')->with('save',true);
        }
        return abort(500);
    }

    public function destroy(ThemeModel $theme)
    {
        if( $this->themeService->delete($theme) ){
            return redirect()->route("admin.themes.index")->with("delete",true);
        }
    }

}
