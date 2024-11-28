<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\BookingController;



Route::post('/register', [AuthController::class, 'registerUser']);
// Expert Registration Route
Route::post('/register/expert', [AuthController::class, 'registerExpert']);
// Login Route
Route::post('/login', [LoginController::class, 'login']);
Route::get('/user-profile', [UserController::class, 'getUserProfile']);
Route::get('/expert-profile', [ExpertController::class, 'getExpertProfile']);
Route::get('expert/{userId}/bookings', [BookingController::class, 'getExpertBookings']);
Route::get('expert/{userId}/ongoing-bookings', [BookingController::class, 'getOngoingBookings']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
