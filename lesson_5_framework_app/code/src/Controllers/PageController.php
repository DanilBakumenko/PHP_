<?php

namespace Geekbrains\Application1\Controllers;
use Geekbrains\Application1\Application;
use Geekbrains\Application1\Render;

class PageController {

    public function actionIndex() {
        $render = new Render();

        return $render->renderPage('page-index.twig', [
            'time' => date('d/m/y H:i'),
            'title' => 'Главная страница'
        ]);
    }
}