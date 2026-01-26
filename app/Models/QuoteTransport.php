<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class QuoteTransport extends Model
{
    use LogsActivity;
    protected $fillable = [
        'quote_id',
        'car_rental_company',
        'car_type',
        'pickup_location',
        'pickup_datetime',
        'dropoff_location',
        'dropoff_datetime',
        'driver_details',
        'notes',
        'price',
    ];
}
