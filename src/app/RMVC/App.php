<?php

namespace app\RMVC;

use App\RMVC\Route\RouteDispatcher;
use app\RMVC\Route\Router;

class App
{
    public static function run()
    {
        $methodName = ucfirst(strtolower($_SERVER['REQUEST_METHOD']));
        $routeMethodName = "get{$methodName}RouteArr";
        foreach (Router::$routeMethodName() as $routeConfiguration) {
            $routeDispatcher = new RouteDispatcher($routeConfiguration);
            $routeDispatcher->process();
        }
    }
}