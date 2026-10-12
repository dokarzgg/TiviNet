<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\InstallationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang', [PageController::class, 'about'])->name('about');
Route::get('/produk', [ProductController::class, 'index'])->name('products.index');

Route::get('/kontak', [PageController::class, 'contact'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

// Pendaftaran pasang WiFi baru (dari popup produk)
Route::post('/pendaftaran', [InstallationController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('install.store');
