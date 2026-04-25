<?php

namespace Modules\Category\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;
use Livewire\Livewire;
use Modules\Category\App\Livewire\CategoryList;

class CategoryServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'Category';
    protected string $nameLower = 'category';

    protected array $providers = [
        RouteServiceProvider::class,
        EventServiceProvider::class,
    ];

    public function boot(): void
    {
        parent::boot();

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'category');

        // Register Livewire components
        Livewire::component('category-list', CategoryList::class);
    }
}