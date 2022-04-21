<?php

namespace App\Services\Category;


use App\Helpers\Images;
use App\Models\CategoryModel;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\Base\BaseService;
use Illuminate\Support\Facades\App;

class CategoryService extends BaseService {
    protected CategoryRepositoryInterface $categoryRepository;
    protected BaseService $baseService;
    public function __construct()
    {
        $this->categoryRepository = App::make(CategoryRepository::class);
        $this->baseService = new BaseService($this->categoryRepository);
//         dd($this->baseService->get(["title","like","%a%"]));
    }

    public function paginate(int $paginate)
    {
        return $this->categoryRepository->paginate($paginate);
    }

    public function get(array $condition)
    {
        return $this->categoryRepository->get($condition);
    }

    public function save(array $object,int $id= null)
    {
        return $this->categoryRepository->save($object,$id);
    }

    public function update(array $object,string $slug)
    {
        return $this->categoryRepository->save($object,$slug);
    }

    public function delete(CategoryModel $model)
    {
        return $model->delete();
    }



    public function syncCategory($object,array $categoryIds)
    {
        return $object->categories()->sync($categoryIds);
    }

    public function detachCategory($object)
    {
        if($object->categories->count()){
            $object->categories()->detach(null);
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
}
