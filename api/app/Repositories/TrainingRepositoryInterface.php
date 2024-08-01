<?php

namespace App\Repositories;

interface TrainingRepositoryInterface
{
    public function getAll(array $filters = []);

    public function create(array $data);

    public function update($model, array $data, array $extraData = []);

    public function delete($id);
}