<?php

namespace App\Repositories\Category;

use App\Models\CategoryModel;
use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface{
    public Model $model;
    public function __construct(CategoryModel $model)
    {
        $this->model = $model;
    }
}
