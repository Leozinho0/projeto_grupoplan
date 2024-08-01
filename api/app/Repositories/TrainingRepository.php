<?php

namespace App\Repositories;

use App\Models\Training;

class TrainingRepository extends BaseRepository implements TrainingRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Training::class);
    }

    public function update($model, array $data, array $extraData = [])
    {
        $model->update($data);
        return $model;
    }
}