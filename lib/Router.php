<?php

require_once "controllers/error.php";

class Router
{
    public $uri;
    public $controller;
    public $method;
    public $param;

    public function __construct()
    {
        $this->setUri();
        $this->setController();
        $this->setMethod();
        $this->setParam();

        $controllerFile = 'controllers/' . $this->controller . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerName = $this->getController();
            $uri = $this->getUri();

            // echo '<pre>';
            // echo print_r($uri);
            // echo '</pre>';

            $this->controller = new $controllerName();
            $this->controller->loadModel($controllerName);

            if (isset($uri[1]) && method_exists($this->controller, $uri[1])) {
                $this->controller->{$uri[1]}();
            }
        } else {
            $this->controller = new Fail();
        }
    }

    public function setUri(): void
    {
        $this->uri = isset($_GET["url"]) ? explode("/", $_GET["url"]) : [];
    }

    public function setController(): void
    {
        $this->controller = empty($this->uri[0]) ? "dashboard" : $this->uri[0];
    }

    public function setMethod(): void
    {
        $this->method = !empty($this->uri[1]) ? $this->uri[1] : "";
    }

    public function setParam(): void
    {
        $this->param = !empty($this->uri[2]) ? $this->uri[2] : "";
    }

    public function getUri(): array
    {
        return $this->uri;
    }

    public function getController(): string|null
    {
        return $this->controller;
    }

    public function getMethod(): string|null
    {
        return $this->method;
    }

    public function getParam(): string|null
    {
        return $this->param;
    }
}
