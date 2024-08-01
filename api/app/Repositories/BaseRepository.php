<?php

namespace App\Repositories;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    protected $cacheSeconds;

    public function __construct($modelClass)
    {
        $this->model = $this->makeModel($modelClass);
        $this->cacheSeconds = 10;
    }

    protected function makeModel($modelClass)
    {
        return new $modelClass;
    }

    public function getAll(array $params = [])
    {
        if (request()->query('sortBy')) {
            $sort = request()->query('sortBy')[0];
            if (request()->query('sortDesc')[0] == 'true') {
                $sortDirection = 'asc';
            } else {
                $sortDirection = 'desc';
            }
            $this->model = $this->model->orderBy($sort, $sortDirection);
        }

        if (request()->query('itemsPerPage')) {
            $itensPerPage = request()->query('itemsPerPage');
        } else {
            $itensPerPage = 12;
        }

        return request()->query('page')
            ? $this->model->paginate($itensPerPage)
            : $this->model->get();
    }

    public function create(array $data, array $extraData = [])
    {
        return $this->model->create(collect($data)->merge($extraData)->all());
    }

    public function update($model, array $data, array $extraData = [])
    {
        $model->update(collect($data)->merge($extraData)->all());

        return $model;
    }

    public function delete($model, $forceDelete = false)
    {
        return $forceDelete
            ? $model->forceDelete()
            : $model->delete();
    }
}
