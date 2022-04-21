<?php

namespace App\Services\Event;

use App\Helpers\Images;
use App\Models\EventModel;
use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Support\Facades\App;

class EventService{

    public EventRepositoryInterface $eventRepository;

    public function __construct()
    {
        $this->eventRepository = App::make(EventRepositoryInterface::class);
    }

    public function get(array $condition)
    {
        return $this->eventRepository->get($condition);
    }

    public function paginate(int $paginate)
    {
        return $this->eventRepository->paginate($paginate);
    }

    public function save(array $event,int $id = null)
    {
        return $this->eventRepository->save($event,$id);
    }

    public function update(array $event,string $slug)
    {
        return $this->eventRepository->save($event,$slug);
    }

    public function delete(EventModel $event)
    {
        return $event->delete();
    }

    public function deleteThumbnailFile(EventModel $event)
    {
        if($event->thumbnail != "thumbnail.png"){
            $image = new Images();
            $image->deleteFile(config("upload_image_path.event-thumbnail"),$event->thumbnail);
        }
    }

    public function deleteSeoImage(EventModel $event)
    {
        if($event->seo_image != "thumbnail.png"){
            $image = new Images();
            $image->deleteFile(config("upload_image_path.seo-image"),$event->seo_image);
        }
    }

}
