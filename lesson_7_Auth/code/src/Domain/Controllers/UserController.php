<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Application\Application;
use Geekbrains\Application1\Application\Render;
use Geekbrains\Application1\Application\Auth;
use Geekbrains\Application1\Domain\Models\User;

class UserController extends AbstractController
{

    protected array $actionsPermissions = [
        'actionHash' => ['admin', 'some'],
        'actionSave' => ['admin']
    ];

    public function actionIndex(): string
    {
        $users = User::getAllUsersFromStorage();

        $render = new Render();

        if (!$users) {
            return $render->renderPage(
                'user-empty.tpl',
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Список пуст или не найден"
                ]);
        } else {
            return $render->renderPage(
                'user-index.tpl',
                [
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users
                ]);
        }
    }

    public function actionProfile() : string
    {
        $user = User::getUserFromStorage($_GET['id']);

        $render = new Render();

        return $render->renderPage(
            'user-profile.twig',
            [
                'title' => 'Пользователь номер '.$_GET['id'],
                'user' => $user
            ]);
    }

    public function actionSave(): string
    {
        if (User::validateRequestData()) {
            $user = new User();
            $user->setParamsFromRequestData();
            $user->saveToStorage();

            $render = new Render();

            return $render->renderPage(
                'user-created.tpl',
                [
                    'title' => 'Пользователь создан',
                    'message' => "Создан пользователь " . $user->getUserName() . " " . $user->getUserLastName()
                ]);
        } else {
            throw new \Exception("Переданные данные некорректны");
        }
    }

    public function actionUpdate(): string {
        if(User::exists($_POST['id'])) {
            $user = new User();
            $user->setIdUser($_POST['id']);

            $arrayData = [];

            if(isset($_POST['name']) && !empty($_POST['name'])){
                $arrayData['user_name'] = $_POST['name'];
            }

            if(isset($_POST['lastname']) && !empty($_POST['lastname'])) {
                $arrayData['user_lastname'] = $_POST['lastname'];
            }

            if(isset($_POST['birthday']) && !empty($_POST['birthday'])) {
                $arrayData['user_birthday_timestamp'] = strtotime($_POST['birthday']);
            }
            echo "<pre>";
            print_r($arrayData);
            $user->updateUser($arrayData);
        }
        else {
            throw new \Exception("Пользователь не существует");
        }

        $render = new Render();
        return $render->renderPage(
            'user-created.twig',
            [
                'title' => 'Пользователь обновлен',
                'message' => "Обновлен пользователь " . $user->getIdUser()
            ]);
    }

    public function actionDelete(): string
    {
        if (User::exists($_POST['delete'])) {
            User::deleteFromStorage($_POST['delete']);

            $render = new Render();

            return $render->renderPage(
                'user-removed.twig', []
            );
        } else {
            throw new \Exception("Пользователь не существует");
        }
    }

    public function actionEdit(): string
    {
        $render = new Render();

        return $render->renderPageWithForm(
            'user-form.twig',
            [
                'title' => 'Форма создания пользователя'
            ]);
    }

    public function actionAuth(): string
    {
        $render = new Render();

        return $render->renderPageWithForm(
            'user-auth.tpl',
            [
                'title' => 'Форма логина'
            ]);
    }

    public function actionHash(): string
    {
        return Auth::getPasswordHash($_GET['pass_string']);
    }

    public function actionLogin(): string
    {
        $result = false;

        if (isset($_POST['login']) && isset($_POST['password'])) {
            $result = Application::$auth->proceedAuth($_POST['login'], $_POST['password']);
        }

        if (!$result) {
            $render = new Render();

            return $render->renderPageWithForm(
                'user-auth.tpl',
                [
                    'title' => 'Форма логина',
                    'auth-success' => false,
                    'auth-error' => 'Неверные логин или пароль'
                ]);
        } else {
            header('Location: /');
            return "";
        }
    }
}