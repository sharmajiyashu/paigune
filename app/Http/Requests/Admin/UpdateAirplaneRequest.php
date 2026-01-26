<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAirplaneRequest extends FormRequest
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
            'airline_operator' => 'required|string|max:150',
            'airplane_type'    => 'required|string|max:150',
            'flight_number'    => [
                'required',
                'string',
                'max:50',
                Rule::unique('airplanes', 'flight_number')->ignore($this->route('airplane')),
            ],
            'seats'  => 'nullable|integer|min:1|max:1000',
            'status' => 'required|boolean',
        ];
    }
}
