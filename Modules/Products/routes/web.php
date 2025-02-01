<?php

use Illuminate\Support\Facades\Route;

use Modules\Products\Http\Controllers\ProductsController;
use Modules\Products\Http\Controllers\RecordLabelController;
use Modules\Products\Http\Controllers\StudioMusicController;
use Modules\Products\Http\Controllers\StudioRecordingController;

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
    Route::prefix('products')->group(function () {
        Route::get('recordlabel', [RecordLabelController::class, 'listsProductsRecordLabel']);
        Route::get('recordlabel/add', [RecordLabelController::class, 'addProductsRecordLabel']);
        Route::post('recordlabel/add', [RecordLabelController::class, 'storeProductsRecordLabel']);
        Route::get('recordlabel/edit/{uuid}', [RecordLabelController::class, 'editProductsRecordLabel']);
        Route::post('recordlabel/edit/{uuid}', [RecordLabelController::class, 'updateProductsRecordLabel']);
        Route::get('recordlabel/delete/{uuid}', [RecordLabelController::class, 'destroyProductsRecordLabel']);

        Route::get('studiomusic', [StudioMusicController::class, 'listsProductsStudioMusic']);
        Route::get('studiomusic/add', [StudioMusicController::class, 'addProductsStudioMusic']);
        Route::post('studiomusic/add', [StudioMusicController::class, 'storeProductsStudioMusic']);
        Route::get('studiomusic/edit/{uuid}', [StudioMusicController::class, 'editProductsStudioMusic']);
        Route::post('studiomusic/edit/{uuid}', [StudioMusicController::class, 'updateProductsStudioMusic']);
        Route::get('studiomusic/delete/{uuid}', [StudioMusicController::class, 'destroyProductsStudioMusic']);

        Route::get('studiorecording', [StudioRecordingController::class, 'listsProductsStudioRecording']);
        Route::get('studiorecording/add', [StudioRecordingController::class, 'addProductsStudioRecording']);
        Route::post('studiorecording/add', [StudioRecordingController::class, 'storeProductsStudioRecording']);
        Route::get('studiorecording/edit/{uuid}', [StudioRecordingController::class, 'editProductsStudioRecording']);
        Route::post('studiorecording/edit/{uuid}', [StudioRecordingController::class, 'updateProductsStudioRecording']);
        Route::get('studiorecording/delete/{uuid}', [StudioRecordingController::class, 'destroyProductsStudioRecording']);
    });
});