<?php

require_once "config/db.php";

class Database
{

    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct()
    {
        $this->host = HOST;
        $this->db = DATABASE;
        $this->user = USER;
        $this->password = PASSWORD;
        $this->charset = CHARSET;
    }

    function conn()
    {
        try {
            $connection = "mysql:host=" . HOST . ";"
                . "dbname=" . DATABASE . ";"
                . "charset=" . CHARSET . ";";

            $options = [
                PDO::ATTR_ERRMODE           =>  PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES  => FALSE,
            ];

            $pdo = new PDO($connection, USER, PASSWORD, $options);

            return $pdo;
        } catch (PDOException $e) {
            require_once("views/error");
        }
    }
}
