<?php

namespace App\Services\Base;

use App\Repositories\Base\BaseRepositoryInterface;

class BaseService implements BaseServiceInterface {
    public BaseRepositoryInterface $repository;
    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
