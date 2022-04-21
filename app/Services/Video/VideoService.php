<?php

namespace App\Services\Video;

use App\Helpers\Images;
use App\Models\videoModel;
use App\Repositories\Video\VideoRepositoryInterface;
use Illuminate\Support\Facades\App;

class VideoService{
    public VideoRepositoryInterface $videoRepository;

    public function __construct()
    {
        $this->videoRepository = App::make(VideoRepositoryInterface::class);
    }

    public function get(array $condition)
    {
        return $this->videoRepository->get($condition);
    }

    public function paginate(int $paginate)
    {
        return $this->videoRepository->paginate($paginate);
    }

    public function save(array $video,int $id = null)
    {
        return $this->videoRepository->save($video,$id);
    }

    public function update(array $video,string $slug)
    {
        return $this->videoRepository->save($video,$slug);
    }

    public function delete(VideoModel $video)
    {
        return $video->delete();
    }

    public function deleteThumbnailFile(VideoModel $video)
    {
        if($video->thumbnail != "thumbnail.png"){
            $image = new Images();
            $image->deleteFile(config("upload_image_path.video-thumbnail"),$video->thumbnail);
        }
    }

    public function deleteSeoImage(VideoModel $video)
    {
        if($video->seo_image != "thumbnail.png"){
            $image = new Images();
            $image->deleteFile(config("upload_image_path.seo-image"),$video->seo_image);
        }
    }

}
