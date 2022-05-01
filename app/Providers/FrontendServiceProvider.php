<?php

namespace App\Providers;

use App\Repositories\Menu\MenuRepositoryInterface;
use App\Repositories\Theme\ThemeRepositoryInterface;
use App\Services\Frontend\FrontendService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FrontendServiceProvider extends ServiceProvider
{
    public FrontendService $frontendService;
    public ThemeRepositoryInterface $themeRepository;
    public MenuRepositoryInterface $menuRepository;

    public function __construct()
    {
        $this->frontendService = App::make(FrontendService::class);
        $this->themeRepository = App::make(ThemeRepositoryInterface::class);
        $this->menuRepository = App::make(MenuRepositoryInterface::class);
    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Cache::flush();
        $data = $this->frontendService->index();
        $activeTheme = $this->themeRepository->find(["id","=",$data["theme"]]);
        $menus = $this->menuRepository->get(["parent_id","=",-1])->sortBy("order");
//        $footerLatestPost
        View::share("activeTheme",$activeTheme);
        View::share("activeSidebarDarkLogo",$data["sidebar-dark-logo"]);
        View::share("activeSidebarLightLogo",$data["sidebar-light-logo"]);
        View::share("activeHeaderLightLogo",$data["header-light-logo"]);
        View::share("activeHeaderDarkLogo",$data["header-dark-logo"]);
        View::share("activeFooterLightLogo",$data["footer-light-logo"]);
        View::share("activeFooterDarkLogo",$data["footer-dark-logo"]);
        View::share("menus",$menus);
    }
}
