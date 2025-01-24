<?php

use Illuminate\Support\Facades\Route;
use Modules\MasterData\Http\Controllers\MasterDataController;
use Modules\MasterData\Http\Controllers\GenreController;

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

// Route::middleware(['auth','has-permission'])->group(function () {
    Route::prefix('masterdata')->group(function () {
        Route::get('genre', [GenreController::class, 'listsMasterGenre']);
        Route::get('genre/add', [GenreController::class, 'addMasterGenre']);
        Route::post('genre/add', [GenreController::class, 'storeMasterGenre']);
        Route::get('genre/edit/{uuid}', [GenreController::class, 'editMasterGenre']);
        Route::post('genre/edit/{uuid}', [GenreController::class, 'updateMasterGenre']);
        Route::get('genre/delete/{uuid}', [GenreController::class, 'destroyMasterGenre']);
    });
// });