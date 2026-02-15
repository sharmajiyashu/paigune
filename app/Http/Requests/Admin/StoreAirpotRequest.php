<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAirpotRequest extends FormRequest
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

            'city_code' => 'nullable|string|max:10',

            'code' => 'required|string|max:50|unique:airpots,code',

            'airport_code' => 'nullable|string|max:20',
            'alternate_ident' => 'nullable|string|max:50',

            'code_icao' => 'nullable|string|max:10',
            'code_iata' => 'nullable|string|max:10',
            'code_lid'  => 'nullable|string|max:10',

            'type' => 'nullable|string|max:100',

            'elevation' => 'nullable|numeric',

            'city' => 'nullable|string|max:150',
            'state' => 'nullable|string|max:150',

            'longitude' => 'nullable|numeric',
            'latitude'  => 'nullable|numeric',

            'timezone' => 'nullable|string|max:100',
            'country_code' => 'nullable|string|max:10',

            'wiki_url' => 'nullable|url|max:255',
            'airport_flights_url' => 'nullable|string|max:255',

            'alternatives' => 'nullable|string',

            'status' => 'required|in:0,1',

        ];
    }
}
