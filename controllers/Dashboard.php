<?php

class Dashboard extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function show(): void
    {
        $this->view->render("dashboard");
    }

    public function printData(): void
    {
        $alumni = $this->model->getStudents();
        echo $alumni;
    }

    public function printNewStudent(): void
    {
        if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
            $this->model->addStudent($_POST);
        }
    }

    public function printUpdates(): void
    {
        if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "PUT") {
            parse_str(file_get_contents("php://input"), $_PUT);
            $this->model->updateStudent($_PUT);
        }
    }

    public function showDelete(): void
    {
        if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "DELETE") {
            parse_str(file_get_contents("php://input"), $_DELETE);
            $this->model->deleteStudent($_DELETE);
        }
    }
}
