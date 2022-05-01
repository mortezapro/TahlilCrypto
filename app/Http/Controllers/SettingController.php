<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Models\SettingModel;
use App\Services\Setting\SettingService;
use Illuminate\Support\Facades\App;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{

    public SettingService $settingService;

    public function __construct()
    {
        $this->settingService = App::make(SettingService::class);
    }

    public function index()
    {
        $settings = $this->settingService->paginate(10);
        return view("panel.settings.index",compact("settings"));
    }

    public function create()
    {
        return view("panel.settings.new");
    }

    public function edit(SettingModel $setting)
    {
        return view("panel.settings.edit",compact("setting"));
    }

    public function store(SettingRequest $request, SettingModel $setting = null)
    {
        $settingData = $request->all();

        $setting ? $this->settingService->save($settingData,$setting->id) : $setting = $this->settingService->save($settingData);

        // there is a situation that setting has not changed, but gallery request changed. this situation SettingObserver has not performed updated method.
        // so, we should check gallery request in the controller.
        // if request has any gallery then upload it and save to db and sync galleriables
        // and also category request

        if($setting){
            return redirect()->route('admin.settings.index')->with('save',true);
        }
        return abort(500);
    }

    public function destroy(SettingModel $setting)
    {
        if( $this->settingService->delete($setting) ){
            return redirect()->route("admin.settings.index")->with("delete",true);
        }
    }

}
