<?php

class DashboardModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $query = $this->db->conn()->prepare("SELECT a.id, a.name, a.email, a.age, b.postal_code, a.phone_number, b.state, b.city, b.street_address
        FROM alumni AS a
        INNER JOIN addresses AS b ON a.address_id = b.id");

        try {
            $query->execute();
            $alumni = $query->fetchAll();
            foreach ($alumni as $row) {
                $output[] = array(
                    'id'    => $row['id'],
                    'name'  => $row['name'],
                    'email'   => $row['email'],
                    'age'    => $row['age'],
                    'postalCode'   => $row['postal_code'],
                    'phoneNumber'   => $row['phone_number'],
                    'state'   => $row['state'],
                    'city'   => $row['city'],
                    'streetAddress'   => $row['street_address'],
                );
            }
            header("Content-Type: application/json");
            return json_encode($output);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function add($data)
    {
        $query = $this->db->conn()->prepare("INSERT INTO alumni (name, email, age, phone_number)
          VALUES(:name, :email, :age, :phone_number);");
        $query2 = $this->db->conn()->prepare("INSERT INTO addresses (postal_code, state, city, street_address) 
          VALUES(:postal_code,:state, :city, :street_address);");

        try {
            $query->execute(["name" => $data["name"], "email" => $data["email"], "age" => $data["age"], "phone_number" => $data["phone_number"]]);
            $query2->execute(["postal_code" => $data["postal_code"], "state" => $data["state"], "city" => $data["city"], "street_address" => $data["street_address"]]);
            // $alumni = $query->fetch();
            return true;
        } catch (PDOException $e) {
            return [];
        }
    }
}
