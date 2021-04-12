<?php

namespace Phpshko\LaravelLivewireDepDrop;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelLivewireTablesServiceProvider.
 */
class LaravelLivewireDepDropProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-livewire-depdrop');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-livewire-depdrop'),
            ], 'views');
        }
    }
}
