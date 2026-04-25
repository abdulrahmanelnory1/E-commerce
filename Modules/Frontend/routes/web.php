<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\App\Livewire\FrontendIndex;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('frontends', FrontendIndex::class)->name('frontend.index');
});
