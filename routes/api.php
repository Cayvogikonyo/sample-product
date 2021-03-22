<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\OrderController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\SupplierController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware(['auth:sanctum'])->group(function () {


    Route::get('elements', [OrderController::class, 'stats'])->name('elements');
    Route::get('orders', [OrderController::class, 'index'])->name('orders');
    Route::get('top-sales', [OrderController::class, 'topThree'])->name('top-sales');
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers');
    Route::get('product-supplies', [SupplierController::class, 'supplyProducts'])->name('product-supplies');
    Route::post('new-product', [ProductController::class, 'saveProduct'])->name('new-product');
    Route::post('new-supplier', [SupplierController::class, 'saveSupplier'])->name('new-supplier');
    Route::post('new-order', [OrderController::class, 'saveOrder'])->name('new-order');
    Route::post('delete-order', [OrderController::class, 'delete'])->name('delete-order');
    Route::get('reports/product-sales', [OrderController::class, 'orderStats'])->name('product-reports');
    Route::post('new-supply', [SupplierController::class, 'saveSupplierProduct'])->name('new-supply');

// });
