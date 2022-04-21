<?php

namespace App\Observers;

use App\Models\CategoryModel;
use App\Services\Category\CategoryService;

class CategoryObserver
{

    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function deleting(CategoryModel $category)
    {
        // delete thumbnail of category if exist
        $this->categoryService->deleteThumbnailFile($category);

        // delete seo_image of event if exist
        $this->categoryService->deleteSeoImage($category);

        if($category->categories->count() > 0){
            $this->categoryService->detachCategory($category);
        }
    }

}
