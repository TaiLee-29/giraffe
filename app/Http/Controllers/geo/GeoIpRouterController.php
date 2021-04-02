<?php


namespace App\Http\Controllers\geo;


use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Providers\GeoIpServiceProvider;
use Tai\Geo\GeoIpInterface;
use Tai\Geo\UserAgentInterface;

class GeoIpRouterController extends Controller
{
    protected $geoRoute;
    protected $agent;

    public function __construct(GeoIpInterface $geoRoute, UserAgentInterface $agent)
    {
        $this->geoRoute = $geoRoute;
        $this->agent = $agent;


    }


    public function route()
    {



        $ip = request()->ip() != '127.0.0.1' ?: request()->server->get('HTTP_X_FORWARDED_FOR');

        $this->geoRoute->parse($ip);
        $this->agent->parse(request()->server->get('HTTP_USER_AGENT'));



        Visit::create([
            'ip' => $ip,
            'continent_code' => $this->geoRoute->continentCode(),
            'country_code' => $this->geoRoute->countryCode(),
            'clientOs' => $this->agent->clientOs(),
            'clientBrowser' => $this->agent->clientBrowser(),

        ]);
        return redirect()->route('index');

    }


}
