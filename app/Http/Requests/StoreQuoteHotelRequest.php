<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteHotelRequest extends FormRequest
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
            'quote_id'     => 'required|exists:quotes,id',
            'hotel_name'   => 'required|string|max:255',
            'country'      => 'required|string|max:150',
            'location'     => 'required|string|max:150',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after_or_equal:checkin_date',
            'room_type'    => 'required|string|max:100',
            'guests'       => 'required|integer|min:1',
            'reference'    => 'nullable|string|max:150',
            'notes'        => 'nullable|string',
            'price'        => 'nullable|numeric|min:0',
        ];
    }
}
