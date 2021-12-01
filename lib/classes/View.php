<?php

class View
{
    public function __construct()
    {
    }

    public function render(string $name): void
    {
        require_once "views/" . $name . "/index.php";
    }
}
