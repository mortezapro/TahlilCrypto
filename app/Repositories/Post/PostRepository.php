<?php

namespace App\Repositories\Post;

use App\Models\PostModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class PostRepository extends BaseRepository implements PostRepositoryInterface {

    public Model $model;
    public function __construct(PostModel $model)
    {
        $this->model = $model;
    }

    public function related(array $categoryIds,PostModel $post,int $count)
    {
        return $this->model->whereHas("categories",function ($q) use ($categoryIds,$post,$count){
            $q->whereIn("id",$categoryIds);
        })->where("id","!=",$post->id)->latest()->take($count)->get();
    }
}
