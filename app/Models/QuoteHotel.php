<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteHotel extends Model
{
    protected $fillable = [
        'quote_id',
        'hotel_name',
        'country',
        'location',
        'checkin_date',
        'checkout_date',
        'room_type',
        'guests',
        'reference',
        'notes',
        'price',
    ];
}
