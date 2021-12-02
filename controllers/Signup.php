<?php

class Signup extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show()
    {
        $this->view->render("signup");
    }

    public function register()
    {
        $result = $this->model->signUp($_POST);

        if (!$result) {
            $this->view->alert = ["text" => "Wrong password or email", "type" => "danger"];
            $this->show();
        } else {
            header('Location: ' . BASE_URL . 'dashboard/show');
        }
    }
}
