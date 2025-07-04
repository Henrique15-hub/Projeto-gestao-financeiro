<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'min:3',
            ],

            'email' => [
                'required',
                'email',
                'string',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'max:255',
                'min:6',
            ],
        ];
    }
}
