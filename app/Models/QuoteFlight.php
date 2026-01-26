<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteFlight extends Model
{
    protected $fillable = [
        'quote_id',

        // Outbound Flight
        'type_of_booking',
        'flight_number',
        'airline_operator',
        'aircraft_type',
        'departure_date',
        'departure_airport',
        'arrival_airport',
        'departure_time',
        'arrival_time',

        // Return Flight
        'return_arrival_date',
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
}
