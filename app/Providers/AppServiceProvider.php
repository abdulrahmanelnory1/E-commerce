<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\Category\App\Livewire\CategoryList;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function () {
            App::setLocale(session('locale', config('app.locale')));
        });

        // Register Livewire components
        Livewire::component('category::category-list', CategoryList::class);
    }
}
