<?php

namespace App\Repositories\Post;

use App\Models\PostModel;
use App\Repositories\Base\BaseRepositoryInterface;

interface PostRepositoryInterface extends BaseRepositoryInterface {
    public function related(array $categoryIds,PostModel $post,int $count);
}
