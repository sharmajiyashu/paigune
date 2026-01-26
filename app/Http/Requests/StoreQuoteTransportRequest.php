<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteTransportRequest extends FormRequest
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
            'quote_id' => 'required|exists:quotes,id',

            'car_rental_company' => 'required|string|max:255',
            'car_type'           => 'required|string|max:255',

            'pickup_location'   => 'required|string|max:255',
            'pickup_datetime'   => 'required|date',

            'dropoff_location'  => 'required|string|max:255',
            'dropoff_datetime'  => 'required|date|after_or_equal:pickup_datetime',

            'driver_details'    => 'required|string',
            'notes'             => 'nullable|string',

            'price'             => 'nullable|numeric|min:0',
        ];
    }
}
