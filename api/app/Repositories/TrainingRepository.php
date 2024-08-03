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

    public function getByUser($user, $params = [])
    {
        $allTrainings = Training::all();
        $completedTrainings = $user->trainings;
        $completedTrainingIds = $completedTrainings->pluck('id')->toArray();

        $allTrainings = $allTrainings->map(function ($training) use ($completedTrainingIds) {
            $training->completed = in_array($training->id, $completedTrainingIds);
            return $training;
        });

        return $allTrainings;
    }

    public function addByUser($user, $params = [])
    {
        $training = Training::whereUuid($params['training'])->first();

        $user->trainings()->toggle($training);
        return true;
    }
}