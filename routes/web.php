<?php

use App\Livewire\ProfileEdit;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lang/{locale}', function (string $locale) {
    $locale = in_array($locale, ['en', 'ar']) ? $locale : config('app.locale');
    session(['locale' => $locale]);
    return back();
})->name('lang.switch');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', ProfileEdit::class)
        ->name('profile.edit');

});

require __DIR__.'/auth.php';