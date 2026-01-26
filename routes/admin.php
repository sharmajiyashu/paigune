<?php

use App\Http\Controllers\Admin\{
    AgentController,
    AirplaneController,
    AirpotController,
    ClientController,
    HomeController,
    LogController,
    LoginController,
    NotificationController,
    QuoteController,
    TripController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('check_login', 'checkLogin')->name('check_login');
    Route::get('logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['isAdmin'])
    ->group(function () {

        Route::get('/', [HomeController::class, 'index'])->name('dashboard');

        Route::resources([
            'clients'       => ClientController::class,
            'agents'        => AgentController::class,
            'airplanes'     => AirplaneController::class,
            'airpots'       => AirpotController::class,
            'notifications' => NotificationController::class,
            'logs'          => LogController::class,
            'quotes'        => QuoteController::class,
            'trips'        => TripController::class,
        ]);

        Route::get('quotes/flights/{id}',[QuoteController::class,'flights'])->name('quotes.flights');
        Route::get('quotes/hotels/{id}',[QuoteController::class,'hotels'])->name('quotes.hotels');
        Route::get('quotes/transports/{id}',[QuoteController::class,'transports'])->name('quotes.transports');
        Route::get('quotes/others/{id}',[QuoteController::class,'others'])->name('quotes.others');


        Route::post('quotes/flights/update',[QuoteController::class,'flightUpdate'])->name('quotes.flights.store');
        Route::post('quotes/hotels/update',[QuoteController::class,'hotelUpdate'])->name('quotes.hotels.store');
        Route::post('quotes/trsanports/update',[QuoteController::class,'transportUpdate'])->name('quotes.trsanports.store');
        Route::post('quotes/others/update',[QuoteController::class,'otherUpdate'])->name('quotes.others.store');
    });
