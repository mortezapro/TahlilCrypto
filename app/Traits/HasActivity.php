<?php

namespace App\Traits;
use App\Services\Activity\ActivityService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

trait HasActivity{
    public function bootHasActivity()
    {
        /*DB::listen(function($sql) {
            // general query log
            Log::info($sql->sql);
            Log::info($sql->bindings);
            Log::info($sql->time);

        });*/
        static::created(function ($query){
            $activityService = new ActivityService();
            $activityService->save($query,"created");
        });
        static::updated(function ($query){
            $activityService = new ActivityService();
            $activityService->save($query,"updated");
        });
        static::deleted(function ($query){
            $activityService = new ActivityService();
            $activityService->save($query,"deleted");
        });
    }
}
