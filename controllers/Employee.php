<?php

class Employee extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->view->render("employee");
    }
}
