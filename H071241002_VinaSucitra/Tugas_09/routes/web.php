<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('categories', CategoryController::class);
Route::resource('warehouses', WarehouseController::class);
Route::resource('products', ProductController::class);
Route::get('stocks', [StockController::class, 'index'])->name('stocks.index');
Route::post('stocks/transfer', [StockController::class, 'transfer'])->name('stocks.transfer');