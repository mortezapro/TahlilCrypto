<?php

namespace App\Services\Comment;

use App\Models\CommentModel;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Support\Facades\App;

class CommentService{

    public CommentRepositoryInterface $commentRepository;

    public function __construct()
    {
        $this->commentRepository = App::make(CommentRepositoryInterface::class);
    }
    public function get(array $condition)
    {
        return $this->commentRepository->get($condition);
    }

    public function paginate(int $paginate)
    {
        return $this->commentRepository->paginate($paginate);
    }

    public function save(array $comment,int $id = null)
    {
        return $this->commentRepository->save($comment,$id);
    }

    public function update(array $comment,int  $id)
    {
        return $this->commentRepository->save($comment,$id);
    }

    public function delete(CommentModel $comment)
    {
        return $comment->delete();
    }
}
