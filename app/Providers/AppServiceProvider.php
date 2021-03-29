<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\ServiceRepositoryInterface',
            'App\Repositories\ServiceRepository'
        );
        $this->app->bind(
            'App\Repositories\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );
        $this->app->bind(
            'App\Services\RegisterServiceInterface',
            'App\Services\RegisterService'
        );
        $this->app->bind(
            'App\Services\SubscriptionManagementServiceInterface',
            'App\Services\SubscriptionManagementService'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
