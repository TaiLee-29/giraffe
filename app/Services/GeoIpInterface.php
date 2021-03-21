<?php

namespace App\Services;


interface GeoIpInterface
{
public function continentCode();

public function countryCode();

public function parse($ip);

}
