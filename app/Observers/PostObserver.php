<?php

namespace App\Observers;

use App\Models\PostModel;
use App\Services\Category\CategoryService;
use App\Services\Gallery\GalleryService;
use App\Services\Post\PostService;
use Illuminate\Support\Facades\App;

class PostObserver
{
    protected CategoryService $categoryService;
    protected GalleryService $galleryService;
    protected PostService $postService;

    public function __construct()
    {
        $this->categoryService = App::make(CategoryService::class);
        $this->galleryService = App::make(GalleryService::class);
        $this->postService = App::make(PostService::class);
    }
    /**
     * Handle the PostModel "created" event.
     *
     * @param PostModel $post
     * @return void
     */
    public function created(PostModel $post)
    {

    }

    /**
     * Handle the PostModel "updated" event.
     *
     * @param PostModel $post
     */
    public function updated(PostModel $post)
    {

    }

    /**
     * Handle the PostModel "deleted" event.
     *
     * @param  PostModel  $post
     * @return void
     */
    public function deleting(PostModel $post)
    {
        // delete thumbnail of post if exist
        $this->postService->deleteThumbnailFile($post);

        // delete seo_image of event if exist
        $this->postService->deleteSeoImage($post);

        // detach all category of post
        $this->categoryService->detachCategory($post);

        //detach all gallery of post if exist
        $this->galleryService->detachGalleries($post,"post","App\Models\PostModel");
    }

    /**
     * Handle the PostModel "restored" event.
     *
     * @param  PostModel  $postModel
     * @return void
     */
    public function restored(PostModel $postModel)
    {
        //
    }

    /**
     * Handle the PostModel "force deleted" event.
     *
     * @param  PostModel  $postModel
     * @return void
     */
    public function forceDeleted(PostModel $postModel)
    {
        //
    }
}
