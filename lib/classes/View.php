<?php

class View
{

    public function __construct()
    {
    }

    public function render($name)
    {
        // require_once "views/" . $name . ".php";
        require_once "views/" . $name . "/index.php";
    }
}
