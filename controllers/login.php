<?php

class Login extends Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->view->render("login");
    // $this->loadModel("login");
  }

  public function logoutUser()
  {
    $this->model->logout();
    header('Location: ' . BASE_URL . 'login');
  }

  public function loginUser()
  {
    // echo $_POST;
    // die();

    $result = $this->model->login($_POST['email'], $_POST['password']);

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
