
<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\App\Livewire\ProductList;
use Modules\Product\App\Livewire\ProductShow;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/subcategories/{subCategory}/products', ProductList::class)
        ->name('products.index');

    Route::get('/products/{product}', ProductShow::class)
        ->name('products.show');
});