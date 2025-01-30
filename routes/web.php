<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'postLogin'])->name('login');
Route::get('registration', [AuthController::class, 'registration']);
Route::post('registration', [AuthController::class, 'postRegistration'])->name('registration');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');