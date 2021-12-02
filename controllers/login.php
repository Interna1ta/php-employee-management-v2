<?php

class Login extends Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function show()
  {
    $this->view->render("login");
  }

  public function logoutUser()
  {
    $this->model->logout();
    $this->view->alert = ["text" => "Logout successfull", "type" => "success"];
    $this->show();
  }

  public function loginUser()
  {
    $result = $this->model->login($_POST['email'], $_POST['pass']);

    if (!$result) {
      $this->view->alert = ["text" => "Wrong password or email", "type" => "danger"];
      $this->show();
    } else {
      header('Location: ' . BASE_URL . 'dashboard/show');
    }
  }

  function destroySession()
  {
    $this->model->destroySession();
    $this->view->alert = ["text" => "Logout successfull", "type" => "success"];
    $this->show();
  }
}
