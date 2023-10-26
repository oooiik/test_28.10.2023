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

Route::group([
    'prefix'=>'auth',
    'as' => 'auth',
], function (){
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])
        ->middleware('auth:sanctum')->name('logout');
    Route::post('me', [\App\Http\Controllers\AuthController::class, 'me'])
        ->middleware('auth:sanctum')->name('me');
    Route::post('register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('verify-email', [\App\Http\Controllers\AuthController::class, 'verifyEmail'])
        ->name('verifyEmail');
    Route::post('forgot-password', [\App\Http\Controllers\AuthController::class, 'forgotPassword'])
        ->name('forgotPassword');
    Route::post('reset-password', [\App\Http\Controllers\AuthController::class, 'resetPassword']);
});

Route::middleware('auth:sanctum')->group(function () {
});
