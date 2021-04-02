<?php


namespace App\Http\Controllers\geo;


use App\Http\Controllers\Controller;
use App\Jobs\JobGeo;
use App\Models\Visit;
use App\Providers\GeoIpServiceProvider;
use Tai\Geo\GeoIpInterface;
use Tai\Geo\UserAgentInterface;

class GeoIpRouterController extends Controller
{


    public function route()
    {
      $queue = new JobGeo();
      $queue->onQueue('parsing')->dispatch();

       // return redirect()->route('index');
    }


}
