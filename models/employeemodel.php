<?php

class EmployeeModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getStudent($id)
    {
        $query = $this->db->conn()->prepare("SELECT a.*, b.*
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

    public function add($data)
    {
        $query1 = $this->db->conn()->prepare("BEGIN;");
        $query2 = $this->db->conn()->prepare("INSERT INTO addresses (postal_code, state, city, street_address, id) 
          VALUES(:postal_code,:state, :city, :street_address, :id);");
        $query3 = $this->db->conn()->prepare("INSERT INTO alumni (name, last_name, email, age, phone_number, address_id, gender_id)
          VALUES(:name, :last_name, :email, :age, :phone_number, :address_id, :gender_id);");
        $query4 = $this->db->conn()->prepare("COMMIT;");

        $newAddressId = rand(13, 5000);
        $data["id"] = $newAddressId;
        try {
            $query1->execute();
            $query2->execute(["postal_code" => $data["postalCode"], "state" => $data["state"], "city" => $data["city"], "street_address" => $data["streetAddress"], "id" => $newAddressId]);
            $query3->execute(["name" => $data["name"], "last_name" => $data["lastName"], "email" => $data["email"], "age" => $data["age"], "phone_number" => $data["phoneNumber"], "address_id" => $newAddressId, "gender_id" => $data["gender"]]);
            $query4->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
