<?php


namespace App\Services;


interface UserAgentInterface
{
    public function parse(string $userAgent);

    public function clientBrowser();

    public function clientOs();


}
