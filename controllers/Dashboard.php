<?php

class Dashboard extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->view->render("dashboard");
        $this->getEmployees();
    }

    public function getEmployees()
    {
        $this->model->get();
    }
}
