<?php

namespace App\Observers;

use App\Models\EventModel;
use App\Services\Category\CategoryService;
use App\Services\Event\EventService;
use App\Services\Gallery\GalleryService;
use Illuminate\Support\Facades\App;

class EventObserver
{
    protected CategoryService $categoryService;
    protected GalleryService $galleryService;
    protected EventService $eventService;

    public function __construct()
    {
        $this->categoryService = App::make(CategoryService::class);
        $this->galleryService = App::make(GalleryService::class);
        $this->eventService = App::make(EventService::class);
    }
    /**
     * Handle the EventModel "deleted" event.
     *
     * @param  EventModel  $event
     * @return void
     */
    public function deleting(EventModel $event)
    {
        // delete thumbnail of event if exist
        $this->eventService->deleteThumbnailFile($event);

        // delete seo_image of event if exist
        $this->eventService->deleteSeoImage($event);

        // detach all category of event
        $this->categoryService->detachCategory($event);

        //detach all gallery of event if exist
        $this->galleryService->detachGalleries($event,"event","App\Models\EventModel");
    }
}
