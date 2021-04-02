<?php

namespace App\Jobs;

use App\Models\Visit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Tai\Geo\GeoIpInterface;
use Tai\Geo\UserAgentInterface;

class JobGeo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $ip;
    private $userAgent;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ip = null, $userAgent = null)
    {
        $this->onQueue('parsing');
        if ($ip == null) {
            $this->ip = request()->ip() != '127.0.0.1' ?: request()->server->get('HTTP_X_FORWARDED_FOR');
        } else {
            $this->ip = $ip;
        }

        if ($userAgent == null) {
            $this->userAgent = request()->server->get('HTTP_USER_AGENT');
        } else {
            $this->userAgent = $userAgent;
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(GeoIpInterface $geoRoute, UserAgentInterface $agent)
    {
        $geoRoute->parse($this->ip);
        $agent->parse($this->userAgent);



        Visit::create([
            'ip' => $this->ip,
            'continent_code' => $geoRoute->continentCode(),
            'country_code' => $geoRoute->countryCode(),
            'clientOs' => $agent->clientOs(),
            'clientBrowser' => $agent->clientBrowser(),

        ]);
    }
}
