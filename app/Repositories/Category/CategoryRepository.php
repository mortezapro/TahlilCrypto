<?php

namespace App\Repositories\Category;

use App\Models\CategoryModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface{
    public Model $model;
    public function __construct(CategoryModel $model)
    {
        $this->model = $model;
    }

    public function popular(int $count)
    {
        $this->generateCacheKey(__FUNCTION__);
        return Cache::remember($this->cacheKey,$this->cacheDuration , function () use ($count) {
            return $this->model->withCount("posts")->orderBy("posts_count","desc")->take($count)->get();
        });
    }
}
