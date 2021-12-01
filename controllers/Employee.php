<?php
require_once "lib/Router.php";

class Employee extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function showHTML(): void
    {
        $uriArray = explode("/", $_GET["url"]);
        if (isset($uriArray[2])) $param = $uriArray[2];

        if (!empty($param)) {
            $student = $this->model->getStudent($param);
            $this->view->student = $student;
        }

        $this->view->render("employee");
    }

    public function sendNewStudent(): void
    {
        if (isset($_POST)) {
            $this->model->add($_POST);
            header("Location: " . BASE_URL . "/dashboard/showHTML");
        }
    }

    public function updateStudent()
    {
        if (isset($_POST)) {
            $this->model->update($_POST);
            header("Location: " . BASE_URL . "/dashboard/showHTML");
        }
    }
}
