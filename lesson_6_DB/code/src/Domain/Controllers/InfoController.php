<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Domain\Models\Phone;
use Geekbrains\Application1\Domain\Models\SiteInfo;
use Geekbrains\Application1\Application\Render;

class InfoController
{
    public function actionIndex()
    {
        $render = new Render();
        $info = new SiteInfo();
        return $render->renderPage('info.twig', [
            'time' => date('d/m/y H:i'),
            'serverInfo' => $info->getWebServer(),
            'phpVersion' => $info->getPhpVersion(),
            'userAgent' => $info->getUserAgent()
        ]);
    }
}