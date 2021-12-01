<?php

class DashboardModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $query = $this->db->conn()->prepare("SELECT a.id, a.name, a.email, a.age, a.address_id, b.postal_code, a.phone_number, b.state, b.city, b.street_address
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
                    'address_id'    => $row['address_id'],
                    'postalCode'   => $row['postal_code'],
                    'phoneNumber'   => $row['phone_number'],
                    'state'   => $row['state'],
                    'city'   => $row['city'],
                    'streetAddress'   => $row['street_address'],
                );
            }
            return json_encode($output);
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function add($data)
    {
        $connection = $this->db->conn();

        $query1 = $connection->prepare("BEGIN;");
        $query2 = $connection->prepare("INSERT INTO addresses (postal_code, state, city, street_address) 
          VALUES(:postal_code, :state, :city, :street_address);");
        $query3 = $connection->prepare("INSERT INTO alumni (name, email, age, phone_number, address_id, gender_id)
          VALUES(:name, :email, :age, :phone_number, :address_id, :gender_id);");
        $query4 = $connection->prepare("COMMIT;");

        try {
            $query1->execute();
            $query2->execute(["postal_code" => $data["postalCode"], "state" => $data["state"], "city" => $data["city"], "street_address" => $data["streetAddress"]]);
            $lastInsertId = $connection->lastInsertId();
            $query3->execute(["name" => $data["name"], "email" => $data["email"], "age" => $data["age"], "phone_number" => $data["phoneNumber"], "address_id" => $lastInsertId, "gender_id" => 3]);
            $query4->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function update($data)
    {
        $query1 = $this->db->conn()->prepare("BEGIN;");
        $query2 = $this->db->conn()->prepare("UPDATE alumni
        SET name = :name, email = :email, age = :age, phone_number = :phone_number
        WHERE id = :id;");
        $query3 = $this->db->conn()->prepare("UPDATE addresses
        SET postal_code = :postal_code, state = :state, city = :city, street_address = :street_address
        WHERE id = :address_id;");
        $query4 = $this->db->conn()->prepare("COMMIT;");

        try {
            $query1->execute();
            $query2->execute(["name" => $data["name"], "email" => $data["email"], "age" => $data["age"], "phone_number" => $data["phoneNumber"], "id" => $data["id"]]);
            $query3->execute(["postal_code" => $data["postalCode"], "state" => $data["state"], "city" => $data["city"], "street_address" => $data["streetAddress"], "address_id" => $data["address_id"]]);
            $query4->execute();
            return json_encode($data);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function delete($data)
    {
        $query1 = $this->db->conn()->prepare("BEGIN;");
        $query2 = $this->db->conn()->prepare("DELETE FROM alumni
        WHERE id = :id;");
        $query3 = $this->db->conn()->prepare("DELETE FROM addresses
        WHERE id = :id;");
        $query4 = $this->db->conn()->prepare("COMMIT;");

        try {
            $query1->execute();
            $query2->execute(["id" => $data["id"]]);
            $query3->execute(["id" => $data["address_id"]]);
            $query4->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
