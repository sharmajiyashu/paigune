<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteFlightRequest extends FormRequest
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
            'type_of_booking' => 'required|in:one_way,return',
            'flight_number'   => 'nullable|string|max:100',
            'airline_operator' => 'nullable|string|max:255',
            'aircraft_type'   => 'nullable|string|max:255',

            'departure_date'  => 'required|date',
            'departure_airport' => 'required|string|max:10',
            'arrival_airport'   => 'required|string|max:10',

            'departure_time'  => 'required|date_format:H:i',
            'arrival_time'    => 'required|date_format:H:i',

            // Return flight fields (only required if type is return)
            'return_arrival_date'   => 'nullable|required_if:type_of_booking,return|date',
            'return_departure_time' => 'nullable|required_if:type_of_booking,return|date_format:H:i',
            'return_arrival_time'  => 'nullable|required_if:type_of_booking,return|date_format:H:i',

            'empty_leg' => 'nullable|boolean',
            'notes' => 'nullable',
            'price' => 'nullable',
        ];
    }
}
