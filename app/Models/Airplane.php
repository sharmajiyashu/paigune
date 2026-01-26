<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    protected $fillable = [
        'airline_operator',
        'airplane_type',
        'flight_number',
        'seats',
        'status',
    ];
}
