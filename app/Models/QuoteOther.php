<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteOther extends Model
{
    protected $fillable = [
        'quote_id',
        'title',
        'price',
        'notes',
        'date',
        'time',
    ];
}
