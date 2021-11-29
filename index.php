<?php

require_once "lib/classes/Controller.php";
require_once "lib/classes/View.php";
require_once "lib/classes/Model.php";
require_once "lib/Router.php";

$router = new Router();


$controller = $router->getController();
$method = $router->getMethod();
$param = $router->getParam();
