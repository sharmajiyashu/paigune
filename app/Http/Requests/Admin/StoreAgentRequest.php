<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAgentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],

            'mobile' => [
                'required',
                'digits_between:10,15',
                Rule::unique('users', 'mobile'),
            ],
            'profile' => ['required', 'mimes:png,jpg,jpeg'],
            'password' => [
                'required',
                'string',
                'min:8',              // at least 8 characters
                // 'regex:/[a-z]/',      // at least one lowercase letter
                // 'regex:/[A-Z]/',      // at least one uppercase letter
                // 'regex:/[0-9]/',      // at least one number
                // 'regex:/[@$!%*#?&]/', // at least one special character
            ],
        ];
    }
}
