<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Selalu paksa Laravel menggunakan HTTPS di server Railway / Production
        if (config('app.env') === 'production' || env('FORCE_HTTPS', true)) {
            URL::forceScheme('https');
        }
    }
}