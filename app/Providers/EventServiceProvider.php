<?php

namespace App\Providers;

use App\Models\CategoryModel;
use App\Models\EventModel;
use App\Models\PostModel;
use App\Models\VideoModel;
use App\Observers\CategoryObserver;
use App\Observers\EventObserver;
use App\Observers\PostObserver;
use App\Observers\VideoObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        PostModel::observe(PostObserver::class);
        CategoryModel::observe(CategoryObserver::class);
        EventModel::observe(EventObserver::class);
        VideoModel::observe(VideoObserver::class);
    }
}
