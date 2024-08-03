<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => 'unique:users,email|required|min:4|max:100',
            'password' => ['required', 'confirmed', 'min:6', 'max:100'],
        ];

        return $rules;
    }
}
