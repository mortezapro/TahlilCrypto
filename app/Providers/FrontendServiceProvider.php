<?php

namespace App\Providers;

use App\Services\Category\CategoryService;
use App\Services\Frontend\FrontendService;
use App\Services\Menu\MenuService;
use App\Services\Post\PostService;
use App\Services\Theme\ThemeService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FrontendServiceProvider extends ServiceProvider
{
    public FrontendService $frontendService;
    public ThemeService $themeService;
    public MenuService $menuService;
    public PostService $postService;
    public CategoryService $categoryService;
//    public postService $menuRepository;

    public function __construct()
    {
        $this->frontendService = App::make(FrontendService::class);
        $this->themeService = App::make(ThemeService::class);
        $this->menuService = App::make(MenuService::class);
        $this->postService = App::make(PostService::class);
        $this->categoryService = App::make(CategoryService::class);
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
        $data = $this->frontendService->index();
        $activeTheme = $this->themeService->find(["id","=",$data["theme"]]);
        $menus = $this->menuService->get(["parent_id","=",-1])->sortBy("order");
        $footerLatestPost = $this->postService->Latest(4);
        $footerHotCategories = $this->categoryService->popular(4);

        View::share("activeTheme",$activeTheme);
        View::share("activeSidebarDarkLogo",$data["sidebar-dark-logo"]);
        View::share("activeSidebarLightLogo",$data["sidebar-light-logo"]);
        View::share("activeHeaderLightLogo",$data["header-light-logo"]);
        View::share("activeHeaderDarkLogo",$data["header-dark-logo"]);
        View::share("activeFooterLightLogo",$data["footer-light-logo"]);
        View::share("activeFooterDarkLogo",$data["footer-dark-logo"]);
        View::share("menus",$menus);
        View::share("footerLatestPosts",$footerLatestPost);
        View::share("footerHotCategories",$footerHotCategories);
    }
}
