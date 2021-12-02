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
    header('Location: ' . BASE_URL . 'login/show');
  }

  public function loginUser()
  {
    $result = $this->model->login($_POST['email'], $_POST['pass']);

    if (!$result) {
      header('Location: ' . BASE_URL . 'login/show');
      exit();
    }
    header('Location: ' . BASE_URL . 'dashboard/show');
    exit();
  }

  function destroySession()
  {
    $this->model->destroySession();
  }
}
