<?php

namespace Alive2212\LaravelWalletService;

use Alive2212\LaravelWalletService\Providers\EventServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class LaravelWalletServiceServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Register event service provider
        App::register(EventServiceProvider::class);

         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
         $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {

            // Publishing the configuration file.
            $this->publishes([
                __DIR__.'/../config/laravel-wallet-service.php' => config_path('laravel-wallet-service.php'),
            ], 'laravel-wallet-service.config');
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-wallet-service.php', 'laravel-wallet-service');

        // Register the service the package provides.
        $this->app->singleton('laravel-wallet-service', function ($app) {
            return new LaravelWalletService;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-wallet-service'];
    }
}