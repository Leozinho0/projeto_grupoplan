<?php

namespace App\Http\Resources;

class UserResource extends BaseResource
{
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'name' => $this->name,
            'email' => $this->when(optional($request->user())->uuid == $this->uuid, $this->email),
        ]);
    }
}
