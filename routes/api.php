<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\TripController;
use App\Models\User;
use Illuminate\Support\Facades\Request;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('Unauthenticated-login', function (Request $request) {

    return response()->json([
        'message' => 'Unauthenticated. Please log in to access this route.',
    ], 401); // 401 Unauthorized

})->name('login');


Route::get('/token-test', function () {
    $user = User::first();
    return $user->createToken('test-token')->plainTextToken;
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('profile', [AuthController::class, 'updateProfile']);

    Route::get('/airports',[FlightController::class,'airports']);
    Route::get('/arrivals/{icao}',[FlightController::class,'arrivals']);
    Route::get('/departures/{icao}',[FlightController::class,'departures']);
    Route::get('/from-to/{from}/{to}', [FlightController::class, 'fromTo']);
    Route::get('/search-by-flightnumber-date',[FlightController::class,'searchByFlightAndDate']);


    Route::get('quotes',[QuoteController::class,'getData']);
    Route::get('quotes/{id}',[QuoteController::class,'getDetail']);
    Route::delete('quotes/{id}',[QuoteController::class,'delete']);

    Route::post('quotes/change-status/{id}',[QuoteController::class,'changeStatus']);

    Route::get('trips',[TripController::class,'trips']);



});
