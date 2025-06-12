<?php

namespace App\Repositories;

interface PizzaTypeRepositoryInterface
{
    /**
     * Get all pizza types.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Find a pizza type by its ID.
     *
     * @param int $id
     * @return \App\Models\PizzaType|null
     */
    public function findById(int $id);
}
