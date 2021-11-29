<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.83.1">

  <title>PHP Employees Management</title>

  <!-- JQuery -->
  <script src="node_modules\jquery\dist\jquery.min.js"></script>

  <!-- JSGrid -->
  <link type="text/css" rel="stylesheet" href="node_modules\jsgrid\dist\jsgrid.min.css" />
  <link type="text/css" rel="stylesheet" href="node_modules\jsgrid\dist/jsgrid-theme.min.css" />
  <script type="text/javascript" src="node_modules\jsgrid\dist\jsgrid.min.js"></script>

  <!-- Bootstrap -->
  <link type="text/css" rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <script type="text/javascript" defer href="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Custom styles for this template -->
  <link href="assets/css/styles.css" rel="stylesheet">
</head>

<body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand px-3 m-0" href="dashboard">Employees Management</a>
    <ul class="navbar-nav d-flex flex-row justify-content-start mr-auto px-2">
      <li class="nav-item text-nowrap px-2">
        <a class="nav-link" href="dashboard">Dashboard</a>
      </li>
      <li class="nav-item text-nowrap px-2">
        <a class="nav-link" href="employee">Employee</a>
      </li>
    </ul>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap px-2">
        <a class="nav-link" href="./library/loginController.php?logout=true">Sign out</a>
      </li>
    </ul>
  </header>