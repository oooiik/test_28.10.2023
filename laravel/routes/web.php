<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\AuthController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');

Route::post('/login', function () {
    return redirect()->route('any');
})->name('login');

Route::get('/{any}', function () {
    return "api.docs";
})->where('any', '.*')->name('any');
