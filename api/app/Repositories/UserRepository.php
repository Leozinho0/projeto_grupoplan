<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function create(Array $data, Array $extraData = [])
    {
        $data['password'] = bcrypt($data['password']);

        $user = $this->model->create(collect($data)->merge($extraData)->all());
        $user->syncRoles(2); //Operador

        return $user;
    }

    public function update($model, array $data, array $extraData = [])
    {
        $model->update($data);
        return $model;
    }
}
