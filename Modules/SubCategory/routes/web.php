<?php

use Illuminate\Support\Facades\Route;
use Modules\SubCategory\App\Livewire\SubCategoryList;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('categories/{category}/subcategories', SubCategoryList::class)
        ->name('subcategories.index');
});