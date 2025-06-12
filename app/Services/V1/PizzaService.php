<?php

namespace App\Services\V1;

use App\Repositories\PizzaRepositoryInterface;

class PizzaService
{
    protected PizzaRepositoryInterface $pizzaRepository;

    public function __construct(PizzaRepositoryInterface $pizzaRepository)
    {
        $this->pizzaRepository = $pizzaRepository;
    }

    public function getAllPizzas()
    {
        return $this->pizzaRepository->getAll();
    }

    public function getPizzaById(string $id)
    {
        return $this->pizzaRepository->findById($id);
    }

    public function createPizza(array $data)
    {
        return $this->pizzaRepository->create($data);
    }

    public function updatePizza(string $id, array $data)
    {
        return $this->pizzaRepository->update($id, $data);
    }

    public function deletePizza(string $id)
    {
        return $this->pizzaRepository->delete($id);
    }
}
