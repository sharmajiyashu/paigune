<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Airpot extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'city_code',
        'code',
        'status',
        'airport_code',
        'alternate_ident',
        'code_icao',
        'code_iata',
        'code_lid',
        'type',
        'elevation',
        'city',
        'state',
        'longitude',
        'latitude',
        'timezone',
        'country_code',
        'wiki_url',
        'airport_flights_url',
        'alternatives',
    ];


    protected $casts = [
        'alternatives' => 'array',
    ];
}
