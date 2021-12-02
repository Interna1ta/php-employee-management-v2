<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP Employees Management</title>

  <!-- JQuery -->
  <script type="text/javascript" defer src="<?php echo BASE_URL; ?>/node_modules\jquery\dist\jquery.min.js"></script>

  <!-- Bootstrap -->
  <link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <script type="text/javascript" defer href="<?php echo BASE_URL; ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Custom styles for this template -->
  <link href="<?php echo BASE_URL; ?>/assets/css/auth.css" rel="stylesheet">
</head>

<body class="text-center">
  <main class="form-signin">
    <form action="<?php echo BASE_URL ?>login/loginUser" method="POST">
      <img src="<?php echo BASE_URL; ?>/assets/img/assembler_icon.jfif" width="40" height="40" class="me-3" alt="Assembler School">
      <h1 class="h3 mb-4 fw-normal">Please sign in</h1>

      <div class="form-floating text-left mt-2">
        <label for="floatingInput">Email address</label>
        <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" data-bs-toggle="tooltip" data-bs-html="true" title="imassembler@assemblerschool.com">
      </div>
      <div class="form-floating text-left mt-2">
        <label for="floatingPassword">Password</label>
        <input name="pass" type="password" class="form-control" id="floatingPassword" placeholder="Password" title="Assemb13r">
      </div>
      <?php echo (!empty($this->alert)) ? "<div class='alert alert-" . $this->alert['type'] . " mt-2 role='alert'>" . $this->alert['text'] . "</div>" : "" ?>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
    </form>
  </main>

</body>

</html>