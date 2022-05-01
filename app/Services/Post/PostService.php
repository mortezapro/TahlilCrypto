<?php

namespace App\Services\Post;

use App\Helpers\Images;
use App\Models\PostModel;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Support\Facades\App;

class PostService{
    public PostRepositoryInterface $postRepository;

    public function __construct()
    {
        $this->postRepository = App::make(PostRepositoryInterface::class);
    }

    public function get(array $condition)
    {
        return $this->postRepository->get($condition);
    }

    public function paginate(int $paginate)
    {
        return $this->postRepository->paginate($paginate);
    }

    public function save(array $post,int $id = null)
    {
        return $this->postRepository->save($post,$id);
    }

    public function update(array $post,int $id)
    {
        return $this->postRepository->save($post,$id);
    }

    public function delete(PostModel $post)
    {
        return $post->delete();
    }

    public function deleteThumbnailFile(PostModel $post)
    {
        if($post->thumbnail != "thumbnail.png"){
            $image = new Images();
            $image->deleteFile(config("upload_image_path.post-thumbnail"),$post->thumbnail);
        }
    }

    public function deleteSeoImage(PostModel $post)
    {
        if($post->seo_image != "thumbnail.png"){
            $image = new Images();
            $image->deleteFile(config("upload_image_path.seo-image"),$post->seo_image);
        }
    }

    public function related(array $categoryIds,PostModel $post,int $count)
    {
        return $this->postRepository->related($categoryIds,$post,$count);
    }
}
