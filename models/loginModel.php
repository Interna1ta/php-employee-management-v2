<?php

class LoginModel extends Model
{
  public function checkSession()
  {
    // Start session
    session_start();

    $urlFile = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);

    if ($urlFile == "index.php" || $urlFile == "demo") {

      if (!isset($_SESSION["lastConnection"])) {
        // Check for time session
        if ($alert = self::checkTimeExpire()) return $alert;
      }

      if (isset($_SESSION["email"])) {
        header("Location:./src/dashboard.php");
      } else {

        // Check for session error
        if ($alert = self::checkLoginError()) return $alert;

        // Check for info session variable
        if ($alert = self::checkLoginInfo()) return $alert;

        // Check for logout
        if ($alert = self::checkLogout()) return $alert;
      }
    } else {
      if (!isset($_SESSION["email"]) || !isset($_SESSION["lastConnection"])) {
        $_SESSION["loginError"] = "You don't have permission to enter the dashboard. Please Login.";
        header("Location:../index.php");
      }

      if (isset($_SESSION["lastConnection"]) && (time() - $_SESSION["lastConnection"] >= 3000)) {
        $_SESSION["timeExpire"] = "Time expired! Please Login.";
        unset($_SESSION["lastConnection"]);
        self::destroyLastSession();
      }
    }
  }

  public function destroyLastSession()
  {
    // Start session
    session_start();

    // Unset all session variables
    unset($_SESSION);

    // Destroy session cookie
    self::destroySessionCookie();

    // Destroy the session
    session_destroy();
    header("Location:../index.php?timeExpire=true");
  }

  public function destroySession()
  {
    // Start session
    session_start();

    // Unset all session variables
    unset($_SESSION);

    // Destroy session cookie
    self::destroySessionCookie();

    // Destroy the session
    session_destroy();
    header("Location:../../index.php?logout=true");
  }

  public function authUser($_POST)
  {
    // Start session
    session_start();

    // Get form input values
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    echo 'yes';

    // // Now we should look for this values in a database
    // // Instead we'll use static vars
    // if (self::checkUser($email, $pass)) {
    //   // we usually save in a session variable user id and other user data like name, surname....
    //   $_SESSION["email"] = $email;
    //   // we save the last connection
    //   $_SESSION["lastConnection"] = time();
    //   // when we check that the email and password is correct, we redirect the user to the dashboard
    //   header("Location:../dashboard.php");
    // } else {
    //   $_SESSION["loginError"] = "Wrong email or password!";
    //   header("Location:../../index.php");
    // }
  }

  public function checkUser(string $email, string $pass)
  {
    $jsonData = file_get_contents('../../resources/users.json');
    $usersData = json_decode($jsonData, true);
    $users = $usersData["users"];

    foreach ($users as $user) {
      if (array_search(
        $email,
        $user
      ) !== false) {
        $currentUser = $user;
      }
    }

    if (isset($currentUser) && password_verify($pass, $currentUser["password"])) {
      return true;
    } else {
      return false;
    }
  }

  public function destroySessionCookie()
  {
    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
      );
    }
  }

  public function checkLoginError()
  {
    if (isset($_SESSION["loginError"])) {
      $errorText = $_SESSION["loginError"];
      unset($_SESSION["loginError"]);
      return ["type" => "danger", "text" => $errorText];
    }
  }

  public function checkLoginInfo()
  {
    if (isset($_SESSION["loginInfo"])) {
      $infoText = $_SESSION["loginInfo"];
      unset($_SESSION["loginInfo"]);
      return ["type" => "primary", "text" => $infoText];
    }
  }

  public function checkLogout()
  {
    if (isset($_GET["logout"]) && !isset($_SESSION["email"])) return ["type" => "primary", "text" => "Logout succesful"];
  }

  public function checkTimeExpire()
  {
    if (isset($_GET["timeExpire"]) && isset($_SESSION["lastConnection"])) {
      $errorText = $_SESSION["timeExpire"];
      unset($_SESSION["timeExpire"]);
      return ["type" => "danger", "text" => "Time expired! Please Login."];
    }
  }
}
