<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequest extends FormRequest
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
            'client_id' => ['required', 'exists:users,id'],
            'reference_number' => ['required', 'string', 'max:255', 'unique:quotes,reference_number'],
            'internal_ref' => ['nullable', 'string', 'max:255', 'unique:quotes,internal_ref'],
            'total_price' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
