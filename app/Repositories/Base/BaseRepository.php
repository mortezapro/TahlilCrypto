<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BaseRepository implements BaseRepositoryInterface{

    protected Model $model;
    protected ?string $cacheKey;
    protected int $cacheDuration = 3600; //per seconds // 1 hours
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function generateCacheKey($functionName)
    {
        $this->cacheKey = $this->model->getTable()."_".$functionName;
    }

    public function get(array $condition)
    {
        $this->generateCacheKey(__FUNCTION__);
        return Cache::remember($this->cacheKey,$this->cacheDuration , function () use ($condition) {
            return $this->model->where($condition[0],$condition[1],$condition[2])->get();
        });
    }

    public function paginate(int $paginate)
    {
        $this->generateCacheKey(__FUNCTION__);
        return Cache::remember($this->cacheKey,$this->cacheDuration , function () use ($paginate) {
            return $this->model->orderBy("id","desc")->paginate($paginate);
        });
    }

    public function delete(int $id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function truncate()
    {
        return $this->model->truncate();
    }

    public function find(array $condition)
    {
        $this->generateCacheKey(__FUNCTION__);
        return Cache::remember($this->cacheKey,$this->cacheDuration , function () use ($condition) {
            return $this->model->where($condition[0],$condition[1],$condition[2])->first();
        });
    }

    public function save(array $data, int $id = null)
    {
        if($id){
            return $this->model->find($id)->update($data);
        }
        return $this->model->create($data);
    }

    public function all()
    {
        $this->generateCacheKey(__FUNCTION__);
        return Cache::remember($this->cacheKey,$this->cacheDuration , function () {
            return $this->model->orderBy("id","desc")->get();
        });
    }

    public function count(array $condition)
    {
        $this->generateCacheKey(__FUNCTION__);
        return Cache::remember($this->cacheKey,$this->cacheDuration , function () use ($condition) {
            return $this->model->where($condition[0],$condition[1],$condition[2])->count();
        });
    }
    public function whereIn(string $column,array $data)
    {
        $this->generateCacheKey(__FUNCTION__);
        return Cache::remember($this->cacheKey,$this->cacheDuration , function () use ($column,$data) {
            return $this->model->whereIn($column,$data)->get();
        });
    }
}
