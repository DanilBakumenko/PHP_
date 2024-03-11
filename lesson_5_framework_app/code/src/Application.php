<?php

namespace Geekbrains\Application1;

final class Application {

    private const APP_NAMESPACE = 'Geekbrains\Application1\Controllers\\';

    private string $controllerName;
    private string $methodName;
    static private array $config;

    public static function config():array
    {
        return Application::$config;
    }

    public function run() : string {
        Application::$config = parse_ini_file('config.ini',true);
        $routeArray = explode('/', $_SERVER['REQUEST_URI']);

        if(isset($routeArray[1]) && $routeArray[1] != '') {
            $controllerName = $routeArray[1];
        }
        else{
            $controllerName = "page";
        }

        $this->controllerName = Application::APP_NAMESPACE . ucfirst($controllerName) . "Controller";

        if(class_exists($this->controllerName)){
            // пытаемся вызвать метод
            if(isset($routeArray[2]) && $routeArray[2] != '') {
                $methodName = $routeArray[2];
            }
            else {
                $methodName = "index";
            }

            $this->methodName = "action" . ucfirst($methodName);

            if(method_exists($this->controllerName, $this->methodName)){
                $controllerInstance = new $this->controllerName();
                return call_user_func_array(
                    [$controllerInstance, $this->methodName],
                    []
                );
            }
            else {
                header($_SERVER["SERVER_PROTOCOL"]."404 Not found.",false,404);
                header("Location: /error-page.html");
                die();
            }
        }
        else{
            header($_SERVER["SERVER_PROTOCOL"]."404 Not Found",true,404);
            header("Location: /error-page.html");
            die();
        }
    }

    public function render(array $pageVariables) {
        
    }
}