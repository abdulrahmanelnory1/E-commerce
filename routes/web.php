<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    // Subcategories
    Route::get('/categories/{category}/subcategories', [SubCategoryController::class, 'index'])
        ->name('subcategories.index');

    // Products
    Route::get('/subcategories/{subCategory}/products', [ProductController::class, 'index'])
        ->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])
        ->name('products.show');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');
    Route::post('/cart/{product}/add', [CartController::class, 'add'])
        ->name('cart.add');
    Route::patch('/cart/{product}/update', [CartController::class, 'update'])
        ->name('cart.update');
    Route::delete('/cart/{product}/remove', [CartController::class, 'remove'])
        ->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])
        ->name('cart.checkout');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';