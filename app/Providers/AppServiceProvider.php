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
        if ($this->app->environment('production') || env('APP_ENV') === 'production' || true) {
            config(['app.url' => 'https://genderlab01.onrender.com']);
            config(['app.asset_url' => 'https://genderlab01.onrender.com']);
            URL::forceScheme('https');
            URL::forceRootUrl('https://genderlab01.onrender.com');
        }
    }
}
