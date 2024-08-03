<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        //$this->authorizeResource(User::class, 'user');
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->getAll($request->all());
        $users->loadMissing([
            'roles'
        ]);

        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        $user->loadMissing([
            'roles'
        ]);

        return new UserResource($user);
    }

    public function store(CreateUserRequest $request)
    {
        $user = $this->userRepository->create($request->validated(), []);
        $user->loadMissing([
            'roles'
        ]);

        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userRepository->update($user, $request->validated());
        
        $user->refresh();
        $user->loadMissing([
            'roles'
        ]);

        return new UserResource($user);
    }
}
