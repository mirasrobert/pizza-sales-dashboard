<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Repositories\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $model)
    {
        $this->model = $model;
    }
}
