<?php

namespace App\Repositories\Base;

interface BaseRepositoryInterface{
    public function all();
    public function get(array $condition);
    public function paginate(int $paginate);
    public function find(array $condition);
    public function delete(int $id);
    public function truncate();
    public function save(array $data,int $id = null);
    public function count(array $condition);
}
