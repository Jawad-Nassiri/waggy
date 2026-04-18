<?php

namespace Core;

class Router
{
    public function dispatch()
    {
        $url = $_GET['url'] ?? 'home';
        $url = explode('/', trim($url, '/'));

        $controllerName = ucfirst($url[0] ?? 'home') . 'Controller';
        $method = strtolower($url[1] ?? 'index');


        $class = "\\App\\Controllers\\$controllerName";

        if (!class_exists($class)) {
            die("Controller not found");
        }

        $controller = new $class();

        if (!method_exists($controller, $method)) {
            die("Method not found");
        }

        $controller->$method();
    }
}
