<?php

namespace App\Repositories\Comment;

use App\Models\CommentModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface {

    public Model $model;
    public function __construct(CommentModel $model)
    {
        $this->model = $model;
    }

}
