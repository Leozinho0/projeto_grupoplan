<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTrainingRequest;
use App\Http\Requests\UpdateTrainingRequest;
use App\Http\Resources\TrainingResource;
use App\Models\Training;
use App\Repositories\TrainingRepositoryInterface;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    private TrainingRepositoryInterface $trainingRepository;

    public function __construct(TrainingRepositoryInterface $trainingRepository)
    {
        //$this->authorizeResource(Training::class, 'training');
        $this->trainingRepository = $trainingRepository;
    }

    public function index(Request $request)
    {
        $trainings = $this->trainingRepository->getAll($request->all());
        $trainings->loadMissing([]);

        return TrainingResource::collection($trainings);
    }

    public function show(Training $training)
    {
        $training->loadMissing([]);

        return new TrainingResource($training);
    }

    public function store(CreateTrainingRequest $request)
    {
        $training = $this->trainingRepository->create($request->validated(), []);
        $training->loadMissing([]);

        return new TrainingResource($training);
    }

    public function update(UpdateTrainingRequest $request, Training $training)
    {
        $this->trainingRepository->update($training, $request->validated());
        
        $training->refresh();
        $training->loadMissing([]);

        return new TrainingResource($training);
    }
}