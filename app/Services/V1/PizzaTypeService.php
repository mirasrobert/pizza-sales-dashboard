<?php

namespace App\Services\V1;

use App\Models\PizzaType;
use App\Repositories\PizzaTypeRepositoryInterface;

class PizzaTypeService
{
    protected PizzaTypeRepositoryInterface $pizzaTypeRepository;

    public function __construct(PizzaTypeRepositoryInterface $pizzaTypeRepository)
    {
        $this->pizzaTypeRepository = $pizzaTypeRepository;
    }

    public function getAll()
    {
        return $this->pizzaTypeRepository->getAll();
    }

    public function getById(string $id)
    {
        return $this->pizzaTypeRepository->findById($id);
    }
}
