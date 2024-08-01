<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function update($model, array $data, array $extraData = [])
    {
        $model->update($data);
        return $model;
    }
}
