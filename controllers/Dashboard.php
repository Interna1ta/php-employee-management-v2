<?php

class Dashboard extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function showHTML()
    {
        $this->view->render("dashboard");
    }

    public function printData()
    {
        $alumni = $this->model->get();
        echo $alumni;
    }

    public function printNewStudent()
    {
        if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
            $this->model->add($_POST);
        }
    }

    public function printUpdates()
    {
        if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "PUT") {
            parse_str(file_get_contents("php://input"), $_PUT);
            $this->model->update($_PUT);
            // echo $updatedStudent;
        }
    }

    public function showDelete()
    {
        if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "DELETE") {
            parse_str(file_get_contents("php://input"), $_DELETE);
            $this->model->delete($_DELETE);
        }
    }
}
