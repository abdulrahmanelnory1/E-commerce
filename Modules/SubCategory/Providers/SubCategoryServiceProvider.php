<?php

namespace Modules\SubCategory\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\SubCategory\App\Livewire\SubCategoryList;

class SubCategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'subcategory');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        Livewire::component('subcategory-list', SubCategoryList::class);
    }
}