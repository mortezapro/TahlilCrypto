<?php

namespace App\Services\Frontend;

use App\Helpers\ArrayClass;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Repositories\Theme\ThemeRepositoryInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class FrontendService{

    public SettingRepositoryInterface $settingRepository;
    public ThemeRepositoryInterface $themeRepository;

    public function __construct()
    {
        $this->settingRepository = App::make(SettingRepositoryInterface::class);
        $this->themeRepository = App::make(ThemeRepositoryInterface::class);
    }

    // generate data for all pages
    public function index():array
    {
        return ArrayClass::flatten($this->settingRepository->all()->pluck("value","name")->toArray());
    }
}
