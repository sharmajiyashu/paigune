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
    ];
}
