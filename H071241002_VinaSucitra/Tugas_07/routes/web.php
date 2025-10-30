<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/destinasi', [HomeController::class, 'destinasi'])->name('destinasi');
Route::get('/kuliner', [HomeController::class, 'kuliner'])->name('kuliner');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
Route::get('/adat', [HomeController::class, 'adat'])->name('adat');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');   

