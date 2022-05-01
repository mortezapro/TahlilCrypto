<?php

namespace App\Repositories\Post;

use App\Models\PostModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PostRepository extends BaseRepository implements PostRepositoryInterface {

    public Model $model;
    public function __construct(PostModel $model)
    {
        $this->model = $model;
    }

    public function related(array $categoryIds,PostModel $post,int $count)
    {
        $this->generateCacheKey(__FUNCTION__);
        return Cache::remember($this->cacheKey,$this->cacheDuration , function () use ($categoryIds,$post,$count) {
            return $this->model->whereHas("categories",function ($q) use ($categoryIds,$post,$count){
                $q->whereIn("id",$categoryIds);
            })->where("id","!=",$post->id)->latest()->take($count)->get();
        });
    }

    public function latest(int $count)
    {
        $this->generateCacheKey(__FUNCTION__);
        return Cache::remember($this->cacheKey,$this->cacheDuration , function () use ($count) {
            return $this->model->take($count)->latest()->get();
        });
    }
}
