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
            return $e;
        }
    }

    public function add($data)
    {

        $query = $this->db->conn()->prepare("INSERT INTO alumni (name, email, age, phone_number, address_id, gender_id)
          VALUES(:name, :email, :age, :phone_number, :address_id, :gender_id);");
        $query2 = $this->db->conn()->prepare("INSERT INTO addresses (postal_code, state, city, street_address, id) 
          VALUES(:postal_code,:state, :city, :street_address, :id);");

        $newAddressId = rand(13, 5000);
        $data["id"] = $newAddressId;
        try {
            $query2->execute(["postal_code" => $data["postalCode"], "state" => $data["state"], "city" => $data["city"], "street_address" => $data["streetAddress"], "id" => $newAddressId]);
            $query->execute(["name" => $data["name"], "email" => $data["email"], "age" => $data["age"], "phone_number" => $data["phoneNumber"], "address_id" => $newAddressId, "gender_id" => 3]);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function update($data)
    {
        $jsonData = $this->get();
        $decodedData = json_decode($jsonData);

        // print_r($decodedData);

        echo "<p>" . gettype($decodedData) . "</p>";

        $addressId = $this->getAddressId($decodedData, $data["id"]);
        echo "<p>" . $addressId . "</p>";
        die();

        $query = $this->db->conn()->prepare("UPDATE alumni
        SET name = :name, email = :email, age = :age, b.postal_code = :postal_code, phone_number = :phone_number, state = :state, city = :city, b.street_address = :street_address
        WHERE id = :id;");
        $query2 = $this->db->conn()->prepare("UPDATE addresses
        SET postal_code = :postal_code, state = :state, city = :city, street_address = :street_address
        WHERE id = :id;");
        try {
            $query->execute(["name" => $data["name"], "email" => $data["email"], "age" => $data["age"], "phone_number" => $data["phoneNumber"], "id" => $data["id"]]);
            $query2->execute(["postal_code" => $data["postalCode"], "state" => $data["state"], "city" => $data["city"], "street_address" => $data["streetAddress"], "id" => $addressId]);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getAddressId($students, $id)
    {
        foreach ($students as $student) {
            if ($student["id"] === $id) {
                return $student["id"];
            }
        }
    }
}
