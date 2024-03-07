<?php

namespace Geekbrains\Application1\Models;

class SiteInfo
{
    private string $webServer;
    private string $phpVersion;
    private string $userAgent;

    public function __construct()
    {
        $this->webServer = $_SERVER['SERVER_SOFTWARE'];
        $this->phpVersion = phpversion();
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
    }

    public function getWebServer(): string
    {
        return $this->webServer;
    }

    public function getPhpVersion(): string
    {
        return $this->phpVersion;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }




}