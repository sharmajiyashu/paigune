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

    // Get departures from an airport
    Route::get('/departures/{icao}', [FlightAwareController::class, 'departures']);

    // Get arrivals at an airport
    Route::get('/arrivals/{icao}', [FlightAwareController::class, 'arrivals']);

    // Search flights from origin → destination
    Route::get('/from-to/{from}/{to}', [FlightAwareController::class, 'fromTo']);

    // Get all international departures from VIDP (Delhi)
    Route::get('/vidp/international', [FlightAwareController::class, 'internationalDeparturesFromVIDP']);

    Route::get('/sync-airports', [FlightAwareController::class, 'syncAirports']);

});
