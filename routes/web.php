<?php

use App\Http\Controllers\FlightAwareController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// FlightAware API routes
Route::prefix('flightaware')->group(function () {

    // Get info about a single airport by ICAO/IATA code
    Route::get('/airports', [FlightAwareController::class, 'airports']);


    Route::get('/airport/{icao}', [FlightAwareController::class, 'airport']);

    Route::get('/departures/{icao}', [FlightAwareController::class, 'departures']);

    Route::get('/arrivals/{icao}', [FlightAwareController::class, 'arrivals']);

    Route::get('/from-to/{from}/{to}', [FlightAwareController::class, 'fromTo']);

    Route::get('/sync-airports', [FlightAwareController::class, 'syncAirports']);

});
