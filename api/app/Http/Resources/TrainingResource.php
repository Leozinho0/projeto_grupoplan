<?php

namespace App\Http\Resources;

class TrainingResource extends BaseResource
{
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'name' => $this->name,
            'description' => $this->description,
            'users' => UserResource::collection($this->whenLoaded('users')),
        ]);
    }
}
