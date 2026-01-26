<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\LogsActivity;


class Airplane extends Model
{
    use LogsActivity;

    protected $fillable = [
        'airline_operator',
        'airplane_type',
        'flight_number',
        'seats',
        'status',
    ];
}
