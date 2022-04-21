<?php

namespace App\Repositories\SearchHistory;

use App\Models\SearchHistoryModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class SearchHistoryRepository extends BaseRepository implements SearchHistoryRepositoryInterface{

    public Model $model;
    public function __construct( SearchHistoryModel $model)
    {
        $this->model = $model;
    }

}
