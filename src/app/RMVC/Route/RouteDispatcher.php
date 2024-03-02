<?php

namespace app\RMVC\Route;

class RouteDispatcher
{
    private RouteConfiguration $routeConfiguration;
    private string $requestUri = '/';
    private array $paramMap = [];
    private array $requestParamMap = [];

    /**
     * @param RouteConfiguration $routeConfiguration
     */
    public function __construct(RouteConfiguration $routeConfiguration)
    {
        $this->routeConfiguration = $routeConfiguration;
    }

    public function process()
    {
        // refactoring?
        $this->routeConfiguration->setUri($this->cleanUri($this->routeConfiguration->getUri()));
        $this->saveRequestUri();

        $this->setParamMap();

        $this->makeRegexRequest();

        $this->checkRequestRouteWithCurrentRoute();
    }

    private function saveRequestUri(): void
    {
        $currentRequestUri = $_SERVER['REQUEST_URI'];
        if ($currentRequestUri !== '/'){
            $this->requestUri = $this->cleanUri($currentRequestUri);
        }
    }
    private function cleanUri($str): string
    {
       return preg_replace('/(^\/)|(\/$)/','', $str);
    }

    private function setParamMap(): void
    {
        /** @var array $configurationArr */
        $configurationArr = explode('/', $this->routeConfiguration->getUri());

        /** @var string $itemParam */
        /** @var int $keyParam */
        foreach ($configurationArr as $keyParam => $itemParam){
            if (preg_match('/{.*}/', $itemParam,)){
                $this->paramMap[$keyParam] = preg_replace('/(^{)|(}$)/','', $itemParam);
            }
        }
    }

    private function makeRegexRequest()
    {
        $requestUriArray = explode('/', $this->requestUri);

        foreach ($this->paramMap as $paramKey => $paramItem){
            if (!isset($requestUriArray[$paramKey])) return;

            $this->requestParamMap[$paramItem] = $requestUriArray[$paramKey];
            $requestUriArray[$paramKey] = '{.*}';
        }

        $this->requestUri = implode('/',$requestUriArray);
        $this->requestUri = $this->prepareRegex($this->requestUri);
    }
    private function prepareRegex(string $str): string
    {
        return str_replace('/','\/', $str);
    }

    private function checkRequestRouteWithCurrentRoute()
    {
        dump($this->requestUri);
        dump($this->routeConfiguration->getUri());
        dump(preg_match("/$this->requestUri/",$this->routeConfiguration->getUri()));

        if (preg_match("/$this->requestUri/",$this->routeConfiguration->getUri())){
            $this->render();
        }
    }

    private function render()
    {
        $pathController = $this->routeConfiguration->getPathController();
        $action = $this->routeConfiguration->getAction();

        $controller = new $pathController;
        $methodArguments = array_values($this->requestParamMap);
        $controller->$action(...$methodArguments);

    }
}