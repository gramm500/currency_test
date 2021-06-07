<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'max:255',
                'email',
                Rule::unique('users', 'email'),
            ],
            'password' => [
                'required',
                'min:6',
                'max:255',
            ],
            'c_password' => [
                'required',
                'string',
                'same:password',
            ],
        ];
    }
}
