<?php

namespace Modules\Frontend\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class FrontendServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'Frontend';
    protected string $nameLower = 'frontend';

    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];

    public function boot(): void
    {
        parent::boot();  // ← important! keeps the default module behavior

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'frontend');
    }
}
