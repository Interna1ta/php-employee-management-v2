<?php

class Login extends Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->view->render("login");
  }

  // function manageLogin()
  // {
  //   // echo $this->model;
  //   // echo 'yes';
  //   // die();
  //   if (isset($_POST)) {
  //     $this->model->authUser($_POST);
  //   }
  //   // if (isset($_GET['logout'])) {
  //   //   $this->model->destroySession();
  //   // } else {
  //   //   echo $this->model;
  //   //   die();
  //   //   if (method_exists($this->model, 'authUser')) {
  //   //     echo 'yesyes';
  //   //     die();
  //   //     $this->model->authUser();
  //   //   }
  //   // }
  // }

  function authUser()
  {
    $this->model->authUser();
  }

  // function destroySession()
  // {
  //   $this->model->destroySession();
  // }
}
