<?php

namespace App\Providers;

use App\Services\GeoIpInterface;
use App\Services\IpApiGeoService;
use App\Services\MaxMindGeoService;
use Illuminate\Support\ServiceProvider;

class GeoIpServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GeoIpInterface::class, function () {
            return new IpApiGeoService();

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
