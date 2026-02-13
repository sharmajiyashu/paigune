<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airpot;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function airpots(){
        return Airpot::get();
    }
}
