<?php

class Fail extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->view->message = "Resource not found";
        $this->view->render("error");
    }
}
