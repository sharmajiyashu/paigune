<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class QuoteOther extends Model
{
    use LogsActivity;
    protected $fillable = [
        'quote_id',
        'title',
        'price',
        'notes',
        'date',
        'time',
    ];
}
