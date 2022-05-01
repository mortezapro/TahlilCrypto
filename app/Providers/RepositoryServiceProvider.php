<?php

namespace App\Providers;

use App\Repositories\Activity\ActivityRepository;
use App\Repositories\Activity\ActivityRepositoryInterface;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Base\BaseRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Gallery\GalleryRepository;
use App\Repositories\Gallery\GalleryRepositoryInterface;
use App\Repositories\Menu\MenuRepository;
use App\Repositories\Menu\MenuRepositoryInterface;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Post\PostRepository;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Setting\SettingRepository;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Repositories\Theme\ThemeRepository;
use App\Repositories\Theme\ThemeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            BaseRepositoryInterface::class,
            BaseRepository::class,
        );
        $this->app->bind(
            ActivityRepositoryInterface::class,
            ActivityRepository::class,
        );
        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class,
        );
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        );
        $this->app->bind(
            GalleryRepositoryInterface::class,
            GalleryRepository::class,
        );
        $this->app->bind(
            PermissionRepositoryInterface::class,
            PermissionRepository::class,
        );
        $this->app->bind(
            RoleRepositoryInterface::class,
            RoleRepository::class,
        );
        $this->app->bind(
            CommentRepositoryInterface::class,
            CommentRepository::class,
        );
        $this->app->bind(
            SettingRepositoryInterface::class,
            SettingRepository::class,
        );
        $this->app->bind(
            ThemeRepositoryInterface::class,
            ThemeRepository::class,
        );
        $this->app->bind(
            MenuRepositoryInterface::class,
            MenuRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
