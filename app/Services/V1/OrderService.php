<?php

namespace App\Services\V1;

use App\Repositories\OrderRepositoryInterface;

class OrderService
{
    protected OrderRepositoryInterface $repository;
    public function __construct(OrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function paginatedList($perPage)
    {
        return $this->repository->getAllPaginated($perPage);
    }

    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
