<?php
namespace App\Services\Activity;

use App\Repositories\Activity\ActivityRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

class ActivityService{

    protected ActivityRepositoryInterface $activityRepository;

    public function __construct()
    {
        $this->activityRepository = App::make(ActivityRepositoryInterface::class);
    }

    public function get(array $condition)
    {
        return $this->activityRepository->get($condition);
    }

    public function paginate(int $paginate)
    {
        return $this->activityRepository->paginate($paginate);
    }

    public function save(Model $model,string $type)
    {
        $activityData = [
            "record_id" => $model->id,
            "user_id" => Request::user()->id,
            "table_name" => $model->getTable(),
            "url" => Request::url(),
            "subject" => $model->getTable()." ".$type,
            "method" => Request::method(),
            "ip_address" => Request::ip(),
            "user_agent" => Request::userAgent(),
        ];
        return $this->activityRepository->save($activityData);
    }

    public function truncate()
    {
        return $this->activityRepository->truncate();
    }
}
