<?php

namespace App\Repositories;

use App\Models\PizzaType;
use App\Repositories\PizzaTypeRepositoryInterface;

class PizzaTypeRepository implements PizzaTypeRepositoryInterface
{
    /**
     * Get all pizza types.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return PizzaType::all();
    }

    /**
     * Find a pizza type by its ID.
     *
     * @param int $id
     * @return \App\Models\PizzaType|null
     */
    public function findById(int $id)
    {
        return PizzaType::find($id);
    }
}
