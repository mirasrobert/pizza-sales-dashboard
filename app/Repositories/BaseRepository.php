<?php

namespace App\Repositories;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected Model $model;

    /**
     * Get all records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Find a record by its ID.
     *
     * @param string $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById(string $id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a new record.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing record.
     *
     * @param string $id
     * @param array $data
     * @return mixed
     */
    public function update(string $id, array $data)
    {
        $record = $this->findById($id);
        if ($record) {
            return $record->update($data);
        }
        return null;
    }

    /**
     * Delete a record by its ID.
     *
     * @param string $id
     * @return mixed
     */
    public function delete(string $id)
    {
        $record = $this->findById($id);
        if ($record) {
            return $record->delete();
        }
        return null;
    }
}
