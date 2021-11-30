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
            $this->controller = new $controllerName();
            $this->controller->loadModel($controllerName);

            if (isset($uri[1]) && method_exists($this->controller, $uri[1])) {
                $this->controller->{$uri[1]}();
            }
        } else {
            $this->controller = new Fail();
        }
    }

    public function setUri()
    {
        $this->uri = isset($_GET["url"]) ? explode("/", $_GET["url"]) : [];
    }

    public function setController()
    {
        $this->controller = empty($this->uri[0]) ? "dashboard" : $this->uri[0];
    }

    public function setMethod()
    {
        $this->method = !empty($this->uri[1]) ? $this->uri[1] : "";
    }

    public function setParam()
    {
        $this->param = !empty($this->uri[2]) ? $this->uri[2] : "";
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getParam()
    {
        return $this->param;
    }
}
