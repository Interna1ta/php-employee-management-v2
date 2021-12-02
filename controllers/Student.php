<?php
require_once "lib/Router.php";

class Student extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show(): void
    {
        $uriArray = explode("/", $_GET["url"]);
        if (isset($uriArray[2])) $param = $uriArray[2];

        if (!empty($param)) {
            $student = $this->model->getStudent($param);
            $this->view->student = $student;
        }

        $this->view->render("student");
    }

    public function sendNewStudent(): void
    {
        if (isset($_POST)) {
            $this->model->addStudent($_POST);
            header("Location: " . BASE_URL . "/dashboard/show");
        }
    }

    public function updateStudent(): void
    {
        if (isset($_POST)) {
            $this->model->updateStudent($_POST);
            header("Location: " . BASE_URL . "/dashboard/show");
        }
    }
}
