<?php

namespace App\Repositories\Event;

use App\Models\EventModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;
class EventRepository extends BaseRepository implements EventRepositoryInterface {

    public Model $model;
    public function __construct(EventModel $model)
    {
        $this->model = $model;
    }

}
