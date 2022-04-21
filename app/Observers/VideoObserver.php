<?php

namespace App\Observers;

use App\Models\VideoModel;
use App\Services\Category\CategoryService;
use App\Services\Gallery\GalleryService;
use App\Services\Video\VideoService;
use Illuminate\Support\Facades\App;

class VideoObserver
{
    protected CategoryService $categoryService;
    protected GalleryService $galleryService;
    protected VideoService $videoService;

    public function __construct()
    {
        $this->categoryService = App::make(CategoryService::class);
        $this->galleryService = App::make(GalleryService::class);
        $this->videoService = App::make(VideoService::class);
    }
    /**
     * Handle the EventModel "deleted" event.
     *
     * @param VideoModel $video
     * @return void
     */
    public function deleting(VideoModel $video)
    {
        // delete thumbnail of event if exist
        $this->videoService->deleteThumbnailFile($video);

        // delete seo_image of event if exist
        $this->videoService->deleteSeoImage($video);

        // detach all category of event
        $this->categoryService->detachCategory($video);

        //detach all gallery of event if exist
        $this->galleryService->detachGalleries($video,"video","App\Models\VideoModel");
    }
}
