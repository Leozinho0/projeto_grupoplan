<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrainingController;

Route::middleware(['auth:sanctum'])->group(function () {
    //Users
    Route::ApiResource('users', UserController::class)->scoped([
        'user' => 'uuid',
    ]);
    
    //Trainings
    Route::ApiResource('trainings', TrainingController::class)->scoped([
        'training' => 'uuid',
    ]);
    Route::get('/trainings/{training:uuid}/users', [TrainingController::class, 'showWithUsers']);

    Route::get('/users/{user:uuid}/trainings', [TrainingController::class, 'getByUser']);
    Route::post('/users/{user:uuid}/trainings', [TrainingController::class, 'addByUser']);
});