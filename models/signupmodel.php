<?php

class SignupModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function signUp(array $inputUser): bool
    {
        if ($this->checkUser($inputUser)) {
            session_start();
            $_SESSION["email"] = $inputUser["email"];
            $_SESSION["lastConnection"] = time();
            $_SESSION["username"] = $inputUser["username"];
            return $this->insertUser($inputUser);
        }

        return false;
    }

    public function checkUser(array $inputUser): bool
    {
        return $this->getUser($inputUser["email"]);
    }

    public function getUser(string $email): bool
    {
        $connection = $this->db->conn();

        $query = $connection->prepare("SELECT *
        FROM users
        WHERE email = :email;");

        try {
            $query->execute(["email" => $email]);
            $user = $query->fetch();

            return empty($user);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertUser(array $user): bool
    {
        $connection = $this->db->conn();

        $query = $connection->prepare("INSERT INTO users (username, email, pass)
        VALUES (:username, :email, :pass);");

        $encryptedPassword = password_hash($user["pass"], PASSWORD_BCRYPT);

        try {
            $query->execute(["username" => $user["username"], "email" => $user["email"], "pass" => $encryptedPassword]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }
}
