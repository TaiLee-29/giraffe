<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Tai\Geo\GeoIpInterface;
use Tai\Geo\IpApiGeoService;
use Tai\Geo\MaxMindGeoService;

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
            return new MaxMindGeoService();

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
