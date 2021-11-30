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

    public function manageEmployees()
    {
        switch ($_SERVER["REQUEST_METHOD"]) {
            case 'POST':
                $this->model->add($_POST);
                $this->showHTML();
                break;
            case 'PUT':
                // parse_str(file_get_contents("php://input"), $put_vars);
                // updateEmployee($put_vars);
                break;
            case "DELETE":
                // parse_str(file_get_contents("php://input"), $delete_vars);
                // deleteEmployee($delete_vars["id"]);
                break;
            default:
                break;
        }
    }
}
