<?php

namespace App\Providers;

use App\Services\SpiralsoftService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SpiralsoftService::class, function (Application $app) {
            $config = $app['config']['services']['spiralsoft'];
            return new SpiralsoftService($config['get_spiralsoft_url']);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
