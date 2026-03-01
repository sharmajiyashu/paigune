<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class QuoteFlight extends Model
{
    use LogsActivity;
    protected $fillable = [
        'quote_id',
        'flight_json',

        // Booking Info
        'type_of_booking',
        'type_of_flight',

        // Outbound Flight
        'flight_number',
        'airline_operator',
        'aircraft_type',
        'departure_date',
        'departure_airport',
        'arrival_airport',
        'departure_time',
        'arrival_time',

        // Return Flight
        'return_flight_number',
        'return_airline_operator',
        'return_aircraft_type',
        'return_departure_date',
        'return_arrival_date',
        'return_departure_airport',
        'return_arrival_airport',
        'return_departure_time',
        'return_arrival_time',

        'empty_leg',
        'notes',
        'price',
    ];


    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    protected $casts = [
        'flight_json' => 'array',
    ];
}
