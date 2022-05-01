<?php

namespace App\Services\Category;


use App\Helpers\Images;
use App\Models\CategoryModel;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\App;

class CategoryService {
    protected CategoryRepositoryInterface $categoryRepository;
    public function __construct()
    {
        $this->categoryRepository = App::make(CategoryRepository::class);
    }

    public function paginate(int $paginate)
    {
        return $this->categoryRepository->paginate($paginate);
    }

    public function get(array $condition)
    {
        return $this->categoryRepository->get($condition);
    }

    public function save(array $category,int $id= null)
    {
        return $this->categoryRepository->save($category,$id);
    }

    public function update(array $category,int $id)
    {
        return $this->categoryRepository->save($category,$id);
    }

    public function delete(CategoryModel $model)
    {
        return $model->delete();
    }



    public function syncCategory($category,array $categoryIds)
    {
        return $category->categories()->sync($categoryIds);
    }

    public function detachCategory($category)
    {
        if($category->categories->count()){
            $category->categories()->detach(null);
        }
    }

    public function deleteThumbnailFile(CategoryModel $category)
    {
        if($category->thumbnail != "thumbnail.png"){
            $image = new Images();
            $image->deleteFile(config("upload_image_path.category-thumbnail"),$category->thumbnail);
        }
    }

    public function deleteSeoImage(CategoryModel $category)
    {
        if($category->seo_image != "thumbnail.png"){
            $image = new Images();
            $image->deleteFile(config("upload_image_path.seo-image"),$category->seo_image);
        }
    }

    public function popular(int $count)
    {
        return $this->categoryRepository->popular($count);
    }
}
