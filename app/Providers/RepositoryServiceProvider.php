<?php

namespace App\Providers;

use App\Interface\AuthInterface;
use App\Interface\UmkmInterface;
use App\Repository\AuthRepositoryInterface;
use App\Repository\UmkmRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UmkmInterface::class, UmkmRepositoryInterface::class);
        $this->app->bind(AuthInterface::class, AuthRepositoryInterface::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
