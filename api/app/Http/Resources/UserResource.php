<?php

namespace App\Http\Resources;

class UserResource extends BaseResource
{
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'name' => $this->name,
            'email' => $this->email,
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'permissions' => $this->getAllPermissions(),
        ]);
    }
}
