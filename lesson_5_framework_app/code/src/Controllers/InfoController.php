<?php

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Models\Phone;
use Geekbrains\Application1\Models\SiteInfo;
use Geekbrains\Application1\Render;

class InfoController
{
    public function actionIndex()
    {
        $render = new Render();
        $info = new SiteInfo();
        return $render->renderPage('info.twig', [
            'serverInfo' => $info->getWebServer(),
            'phpVersion' => $info->getPhpVersion(),
            'userAgent' => $info->getUserAgent()
        ]);
    }
}