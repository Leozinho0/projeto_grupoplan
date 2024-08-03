<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['email', 'required', 'min:4', 'max:100', Rule::unique('users')->ignore($this->user->id)],
            'password' => ['sometimes', 'required', 'confirmed', 'min:6', 'max:100'],
        ];

        return $rules;
    }
}
