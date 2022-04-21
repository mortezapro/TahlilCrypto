<?php

namespace App\Providers;

use App\Repositories\Activity\ActivityRepository;
use App\Repositories\Activity\ActivityRepositoryInterface;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Base\BaseRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Gallery\GalleryRepository;
use App\Repositories\Gallery\GalleryRepositoryInterface;
use App\Repositories\Post\PostRepository;
use App\Repositories\Post\PostRepositoryInterface;
use App\Services\Base\BaseService;
use App\Services\Base\BaseServiceInterface;
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
            BaseServiceInterface::class,
            BaseService::class,
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
