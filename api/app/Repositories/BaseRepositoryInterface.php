<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function getAll(array $params = []);

    public function create(array $data);

    public function update($model, array $data, array $extraData = []);

    public function delete($model, $forceDelete = false);
}
