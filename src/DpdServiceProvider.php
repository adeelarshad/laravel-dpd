<?php

namespace Proxi\Dpd;

use Illuminate\Support\ServiceProvider;

class DpdServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/dpd_nl.php',
            'dpd_nl'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/dpd_nl.php' => config_path('dpd_nl.php'),
        ], 'config');
    }
}
