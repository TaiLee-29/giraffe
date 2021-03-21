<?php

namespace App\Providers;

use App\Services\UserAgentGetBrowserService;
use App\Services\UserAgentInterface;
use Illuminate\Support\ServiceProvider;

class UserAgentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserAgentInterface::class, function () {
            return new UserAgentGetBrowserService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
