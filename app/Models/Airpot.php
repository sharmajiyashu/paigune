<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airpot extends Model
{
    protected $fillable = [
        'name',
        'city_code',
        'code',
        'status',
    ];
}
