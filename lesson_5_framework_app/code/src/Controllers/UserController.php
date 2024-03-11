<?php

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Render;
use Geekbrains\Application1\Models\User;

class UserController
{

    public function actionIndex()
    {
        $users = User::getAllUsersFromStorage();

        $render = new Render();

        if (!$users) {
            return $render->renderPage(
                'user-empty.twig',
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Список пуст или не найден"
                ]);
        } else {
            return $render->renderPage(
                'user-index.twig',
                [
                    'time' => date('d/m/y H:i'),
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users
                ]);
        }
    }

    public function actionSave() : string
    {
        $name = $_GET["name"];
        $birthday = $_GET["birthday"];

        $address = "./storage/birthdays.txt";

        $res = PHP_EOL . $name . ', ' . $birthday;

        $file = fopen($address, "a");

        if (fwrite($file, $res)) {
            return $this->actionIndex();
        } else {
            return "При добавлении пользователя произошла ошибка";
        }
    }
}