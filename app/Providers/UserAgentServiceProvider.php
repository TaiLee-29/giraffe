<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Tai\Geo\UserAgentGetBrowserService;
use Tai\Geo\UserAgentInterface;

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
