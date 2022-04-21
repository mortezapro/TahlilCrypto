<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class CacheKey{

    public string $cacheKey;

    public function __construct($cacheKey)
    {
        $this->cacheKey = $cacheKey;
    }

    public static function generate(Model $model, $functionName):string
    {
        return $model->getTable()."_".$functionName;
    }
}
