<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\App\Livewire\CategoryList;

Route::middleware(['auth'])->group(function () {
    Route::get('/categories', CategoryList::class)
        ->name('categories.index');
});