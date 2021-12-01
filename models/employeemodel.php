<?php

class EmployeeModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getStudent(string $id): array
    {
        $query = $this->db->conn()->prepare("SELECT a.*, b.postal_code, b.state, b.city, b.street_address
        FROM alumni AS a
        INNER JOIN addresses AS b ON a.address_id = b.id
        WHERE a.id = :id");

        try {
            $query->execute(["id" => $id]);
            $student = $query->fetch();
            return $student;
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function add(array $data): void
    {
        $connection = $this->db->conn();

        $query1 = $connection->prepare("BEGIN;");
        $query2 = $connection->prepare("INSERT INTO addresses (postal_code, state, city, street_address) 
          VALUES(:postal_code,:state, :city, :street_address);");
        $query3 = $connection->prepare("INSERT INTO alumni (name, last_name, email, age, phone_number, address_id, gender_id)
          VALUES(:name, :last_name, :email, :age, :phone_number, :address_id, :gender_id);");
        $query4 = $connection->prepare("COMMIT;");

        try {
            $query1->execute();
            $query2->execute(["postal_code" => $data["postalCode"], "state" => $data["state"], "city" => $data["city"], "street_address" => $data["streetAddress"]]);
            $lastInsertId = $connection->lastInsertId();
            $query3->execute(["name" => $data["name"], "last_name" => $data["lastName"], "email" => $data["email"], "age" => $data["age"], "phone_number" => $data["phoneNumber"], "address_id" => $lastInsertId, "gender_id" => $data["gender"]]);
            $query4->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function update($data)
    {
        $query1 = $this->db->conn()->prepare("BEGIN;");
        $query2 = $this->db->conn()->prepare("UPDATE alumni
        SET name = :name, last_name = :last_name, gender_id = :gender_id, email = :email, age = :age, phone_number = :phone_number
        WHERE id = :id;");
        $query3 = $this->db->conn()->prepare("UPDATE addresses
        SET postal_code = :postal_code, state = :state, city = :city, street_address = :street_address
        WHERE id = :address_id;");
        $query4 = $this->db->conn()->prepare("COMMIT;");

        try {
            $query1->execute();
            $query2->execute(["name" => $data["name"], "last_name" => $data["lastName"], "gender_id" => $data["gender"], "email" => $data["email"], "age" => $data["age"], "phone_number" => $data["phoneNumber"], "id" => $data["id"]]);
            $query3->execute(["postal_code" => $data["postalCode"], "state" => $data["state"], "city" => $data["city"], "street_address" => $data["streetAddress"], "address_id" => $data["addressId"]]);
            $query4->execute();
            return json_encode($data);
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
