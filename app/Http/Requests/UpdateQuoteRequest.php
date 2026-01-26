<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateQuoteRequest extends FormRequest
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
        $quoteId = $this->route('quote'); // gets the quote id from route parameter

        return [
            'client_id' => ['required', 'exists:users,id'],
            'reference_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('quotes', 'reference_number')->ignore($quoteId),
            ],
            'internal_ref' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('quotes', 'internal_ref')->ignore($quoteId),
            ],
            'total_price' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
