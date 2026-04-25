<?php

namespace Modules\Product\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\Product\App\Livewire\ProductList;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load views from the module's resources/views folder
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'product');
        
        // Load migrations from the module's database/migrations folder
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        Livewire::component('product-list', ProductList::class);
    }
}