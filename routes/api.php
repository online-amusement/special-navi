<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix("member")->group(function () {
    Route::post('/temporary-registration', [App\Http\Controllers\EmailVerificationController::class, 'temporaryRegistration']);
    Route::post('/official-registration', [App\Http\Controllers\EmailVerificationController::class, 'officialRegistration']);
    Route::post('/search-address', [App\Http\Controllers\EmailVerificationController::class, "searchAddress"]);
});

Route::middleware(['cors'])->group(function () {
    Route::post('/login', [App\Http\Controllers\MemberController::class, "login"]);
    Route::post('/me', [App\Http\Controllers\MemberController::class, "me"]);
});
