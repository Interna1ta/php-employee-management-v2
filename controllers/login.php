<?php

class Login extends Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function showHTML()
  {
    $this->view->render("login");
  }

  public function logoutUser()
  {
    $this->model->logout();
    header('Location: ' . BASE_URL . 'login');
  }

  public function loginUser()
  {
    $result = $this->model->login($_POST['email'], $_POST['pass']);

    if (!$result) {
      header('Location: ' . BASE_URL . 'login');
      exit();
    }
    header('Location: ' . BASE_URL . 'dashboard');
    exit();
  }

  // function destroySession()
  // {
  //   $this->model->destroySession();
  // }
}
