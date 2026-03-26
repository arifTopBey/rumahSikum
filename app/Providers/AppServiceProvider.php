<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        if ($this->app->environment('development') || $this->app->environment('production')) {
            URL::forceScheme('https');
            $url = $this->app['url'];
            $url->forceRootUrl(config('app.url'));
        }
        Paginator::useBootstrapFive();
    }
}
