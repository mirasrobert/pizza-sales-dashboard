<?php

namespace App\Repositories;

use App\Models\Pizza;
use App\Repositories\BaseRepository;
use App\Repositories\PizzaRepositoryInterface;

class PizzaRepository extends BaseRepository implements PizzaRepositoryInterface
{
    public function __construct(Pizza $model)
    {
        // Overwrite the model used
        $this->model = $model;
    }

    /**
     * Get the model class name.
     *
     * @return string
     */
    protected function getModelClass(): string
    {
        return \App\Models\Pizza::class;
    }

    /**
     * Get the repository name.
     *
     * @return string
     */
    protected function getRepositoryName(): string
    {
        return 'Pizza';
    }
}
