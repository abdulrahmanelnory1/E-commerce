<?php

use Illuminate\Support\Facades\Route;
use Modules\Cart\App\Livewire\Shop;
use Modules\Cart\App\Livewire\Checkout;
use Modules\Cart\App\Livewire\Orders;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/shop', Shop::class)->name('shop.index');
    Route::get('/shop/checkout', Checkout::class)->name('shop.checkout');
    Route::get('/shop/orders', Orders::class)->name('shop.orders');
});
