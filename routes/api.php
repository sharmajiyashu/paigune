<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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
});
