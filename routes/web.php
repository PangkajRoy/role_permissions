<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/shop', function () {
    return view('pages.shop.shop');
})->name('shop');

Route::get('/product-details', function () {
    return view('pages.products.single-product');
})->name('product.details');

Route::get('/cart', function () {
    return view('pages.cart.shopping-cart');
})->name('product.cart');

Route::get('/checkout', function () {
    return view('pages.cart.checkout');
})->name('product.checkout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';
