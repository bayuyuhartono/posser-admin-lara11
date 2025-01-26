<?php

use Illuminate\Support\Facades\Route;

use Modules\Products\Http\Controllers\ProductsController;
use Modules\Products\Http\Controllers\RecordLabelController;

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
    });
});