<?php

class LoginModel extends Model
{
  function __construct()
  {
    parent::__construct();
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
  }

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
        header('Location: ' . BASE_URL . 'dashboard/show');
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
        header('Location: ' . BASE_URL . 'login/show');
      }

      if (isset($_SESSION["lastConnection"]) && (time() - $_SESSION["lastConnection"] >= 3000)) {
        $_SESSION["timeExpire"] = "Time expired! Please Login.";
        unset($_SESSION["lastConnection"]);
        self::destroyLastSession();
      }
    }
  }

  public function logout()
  {
    session_destroy();
  }

  public function destroyLastSession()
  {
    // Unset all session variables
    unset($_SESSION);

    // Destroy session cookie
    $this->destroySessionCookie();

    // Destroy the session
    session_destroy();
    // header("Location:../index.php?timeExpire=true");
    header('Location: ' . BASE_URL . 'login/show');
  }

  public function destroySession()
  {
    // Unset all session variables
    unset($_SESSION);

    // Destroy session cookie
    $this->destroySessionCookie();

    // Destroy the session
    session_destroy();
  }

  public function login(string $email, string $pass): bool
  {
    $user = $this->checkUser($email, $pass);

    if ($user) {
      session_start();
      $_SESSION["email"] = $email;
      $_SESSION["lastConnection"] = time();
      $_SESSION["username"] = $user["username"];
      return true;
    } else {
      return false;
    }
  }

  public function checkUser(string $email, string $pass): array|false
  {
    $user = $this->getUser($email);

    if (empty($user)) {
      return false;
    } else {
      $correctPass = $this->checkPass($pass, $user["pass"]);

      return $correctPass ? $user : false;
    }
  }

  public function getUser(string $email)
  {
    $connection = $this->db->conn();

    $query = $connection->prepare("SELECT *
    FROM users
    WHERE email = :email;");

    try {
      $response = $query->execute(["email" => $email]);
      $user = $query->fetch();

      if (empty($response)) {
        return false;
      } else {
        return $user;
      }
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function checkPass(string $inputPass, string $dbPass): bool
  {
    return password_verify($inputPass, $dbPass);
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

  // public function checkLoginError()
  // {
  //   if (isset($_SESSION["loginError"])) {
  //     $errorText = $_SESSION["loginError"];
  //     unset($_SESSION["loginError"]);
  //     return ["type" => "danger", "text" => $errorText];
  //   }
  // }

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
