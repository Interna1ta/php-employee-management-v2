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
    header('Location: ' . BASE_URL . 'login');
  }

  public function loginUser()
  {
    $result = $this->model->login($_POST['email'], $_POST['pass']);

    if (!$result) {
      $this->view->alert = ["text" => "Wrong password or email", "type" => "danger"];
      require_once 'views/login/index.php';
      // header('Location: ' . BASE_URL . 'login/show');
    } else {
      header('Location: ' . BASE_URL . 'dashboard/show');
    }
  }

  // function destroySession()
  // {
  //   $this->model->destroySession();
  // }
}
