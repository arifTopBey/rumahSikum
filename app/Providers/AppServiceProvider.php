<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD

=======
use Illuminate\Support\Facades\URL;
>>>>>>> 501705a6b2991e5e8265c1a4070acd87d8b9c04a
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
<<<<<<< HEAD
=======
        if ($this->app->environment('development') || $this->app->environment('production')) {
            URL::forceScheme('https');
            $url = $this->app['url'];
            $url->forceRootUrl(config('app.url'));
        }
>>>>>>> 501705a6b2991e5e8265c1a4070acd87d8b9c04a
        Paginator::useBootstrapFive();
    }
}
