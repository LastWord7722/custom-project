<?php

namespace app\RMVC\Route;

class RouteConfiguration
{
    private string $uri;
    private string $action;
    private string $pathController;

    /**
     * @param string $uri
     * @param string $action
     * @param string $pathController
     */
    public function __construct(string $uri, string $pathController, string $action)
    {
        $this->uri = $uri;
        $this->pathController = $pathController;
        $this->action = $action;
    }

    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }
    public function getUri(): string
    {
        return $this->uri;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getPathController(): string
    {
        return $this->pathController;
    }

}