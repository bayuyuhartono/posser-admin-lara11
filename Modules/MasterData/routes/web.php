<?php

use Illuminate\Support\Facades\Route;

use Modules\MasterData\Http\Controllers\GenreController;
use Modules\MasterData\Http\Controllers\CountryController;
use Modules\MasterData\Http\Controllers\CityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth','user-access'])->group(function () {
    Route::prefix('masterdata')->group(function () {
        Route::get('genre', [GenreController::class, 'listsMasterGenre']);
        Route::get('genre/add', [GenreController::class, 'addMasterGenre']);
        Route::post('genre/add', [GenreController::class, 'storeMasterGenre']);
        Route::get('genre/edit/{uuid}', [GenreController::class, 'editMasterGenre']);
        Route::post('genre/edit/{uuid}', [GenreController::class, 'updateMasterGenre']);
        Route::get('genre/delete/{uuid}', [GenreController::class, 'destroyMasterGenre']);

        Route::get('country', [CountryController::class, 'listsMasterCountry']);
        Route::get('country/add', [CountryController::class, 'addMasterCountry']);
        Route::post('country/add', [CountryController::class, 'storeMasterCountry']);
        Route::get('country/edit/{uuid}', [CountryController::class, 'editMasterCountry']);
        Route::post('country/edit/{uuid}', [CountryController::class, 'updateMasterCountry']);
        Route::get('country/delete/{uuid}', [CountryController::class, 'destroyMasterCountry']);

        Route::get('city', [CityController::class, 'listsMasterCity']);
        Route::get('city/add', [CityController::class, 'addMasterCity']);
        Route::post('city/add', [CityController::class, 'storeMasterCity']);
        Route::get('city/edit/{uuid}', [CityController::class, 'editMasterCity']);
        Route::post('city/edit/{uuid}', [CityController::class, 'updateMasterCity']);
        Route::get('city/delete/{uuid}', [CityController::class, 'destroyMasterCity']);
    });
});