<?php

namespace Geekbrains\Application1\Domain\Controllers;
use Geekbrains\Application1\Application\Render;

class PageController {

    public function actionIndex() {
        $render = new Render();
        
        return $render->renderPage('page-index.tpl', [
            'title' => 'Главная страница'
        ]);
    }

    public function actionEndSession()
    {
        session_unset();
        session_destroy();
        $render = new Render();
        return $render->renderPage('page-index.tpl',[
            'title' => 'Главная страница'
            ]);
    }
}