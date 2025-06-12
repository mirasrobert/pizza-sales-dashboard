<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * Get all records.
     *
     * @return Collection
     */
    public function getAll();

    /**
     * Find a record by its ID.
     *
     * @param string $id
     * @return Model
     */
    public function findById(string $id);

    /**
     * Create a new record.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data);

    /**
     * Update an existing record.
     *
     * @param string $id
     * @param array $data
     * @return mixed
     */
    public function update(string $id, array $data);

    /**
     * Delete a record by its ID.
     *
     * @param string $id
     * @return mixed
     */
    public function delete(string $id);
}
