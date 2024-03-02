<?php

namespace app\RMVC\Route;

use App\RMVC\Route\RouteConfiguration;

class Router
{

    public const GET_METHOD = 'get';
    public const POST_METHOD = 'get';

    private static array $getRouteArr = [];
    private static array $postRouteArr = [];

    public static function getPostRouteArr(): array
    {
        return self::$postRouteArr;
    }

    public static function getGetRouteArr(): array
    {
        return self::$getRouteArr;
    }
    public static function get(string $uri, array $controllerAndAction): RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($uri, $controllerAndAction[0], $controllerAndAction[1]);
        self::$getRouteArr[] = $routeConfiguration;
        return $routeConfiguration;
    }
}