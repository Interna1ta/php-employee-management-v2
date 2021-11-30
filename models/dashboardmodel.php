<?php

class DashboardModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $query = $this->db->conn()->prepare("INSERT INTO employees (first_name, last_name) VALUES (:name, :lastName)");

        $query->execute(["name" => $data["name"], "lastName" => $data["last_name"]]);
    }
}
