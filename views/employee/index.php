<?php
// require_once("./library/loginManager.php");

// checkSession();

require 'views/header.php';
?>

<form action="<?php echo BASE_URL; ?>/employee/<?php echo isset($this->student) ? "update" : "sendNewStudent" ?>" method="<?php echo isset($this->student) ? "PUT" : "POST" ?>" class="container mt-4">
    <div class="row">
        <div class="col-sm-6 form-floating mt-3">
            <label for="floatingName">Name</label>
            <input name="name" type="text" class="form-control" id="floatingName" placeholder="John" data-bs-toggle="tooltip" data-bs-html="true" value="<?php echo isset($this->student) ? $this->student["name"] : "" ?>">
        </div>
        <div class="col-sm-6 form-floating mt-3">
            <label for="floatingLastName">Last name</label>
            <input name="lastName" type="text" class="form-control" id="floatingLastName" placeholder="Doe" value="<?php echo isset($this->student) ? $this->student["last_name"] : "" ?>">
        </div>
        <div class="col-sm-6 form-floating mt-3">
            <label for="floatingEmail">Email address</label>
            <input name="email" type="email" class="form-control" id="floatingEmail" placeholder="john.doe@example.com" data-bs-toggle="tooltip" data-bs-html="true" value="<?php echo isset($this->student) ? $this->student["email"] : "" ?>"></input>
        </div>
        <div class="col-sm-6 form-floating mt-3">
            <label for="floatingGender">Gender</label>
            <select name="gender" class="form-control" id="floatingGender" data-bs-toggle="tooltip" data-bs-html="true">
                <option value="1" <?php echo (isset($this->student) && $this->student["gender_id"] === 1) ? "selected" : "" ?>>Man</option>
                <option value="2" <?php echo (isset($this->student) && $this->student["gender_id"] === 2) ? "selected" : "" ?>>Woman</option>
                <option value="3" <?php echo (isset($this->student) && $this->student["gender_id"] === 3) ? "selected" : "" ?>>Other</option>
            </select>
        </div>
        <div class="col-sm-6 form-floating mt-3">
            <label for="floatingCity">City</label>
            <input name="city" type="text" class="form-control" id="floatingCity" placeholder="Barcelona" value="<?php echo isset($this->student) ? $this->student["city"] : "" ?>">
        </div>
        <div class="col-sm-6 form-floating mt-3">
            <label for="floatingStreetAddress">Street address</label>
            <input name="streetAddress" type="text" class="form-control" id="floatingStreetAddress" placeholder="324" data-bs-toggle="tooltip" data-bs-html="true" value="<?php echo isset($this->student) ? $this->student["street_address"] : "" ?>">
        </div>
        <div class="col-sm-6 form-floating mt-3">
            <label for="floatingState">State</label>
            <input name="state" type="text" class="form-control" id="floatingState" placeholder="Catalunya" value="<?php echo isset($this->student) ? $this->student["state"] : "" ?>">
        </div>
        <div class="col-sm-6 form-floating mt-3">
            <label for="floatingAge">Age</label>
            <input name="age" type="number" class="form-control" id="floatingAge" placeholder="18" data-bs-toggle="tooltip" data-bs-html="true" value="<?php echo isset($this->student) ? $this->student["age"] : "" ?>">
        </div>
        <div class="col-sm-6 form-floating mt-3">
            <label for="floatingPostalCode">Postal code</label>
            <input name="postalCode" type="number" class="form-control" id="floatingPostalCode" placeholder="Catalunya" value="<?php echo isset($this->student) ? $this->student["postal_code"] : "" ?>">
        </div>
        <div class="col-sm-6 form-floating mt-3">
            <label for="floatingPhoneNumber">Phone number</label>
            <input name="phoneNumber" type="number" class="form-control" id="floatingPhoneNumber" placeholder="666666666" data-bs-toggle="tooltip" data-bs-html="true" value="<?php echo isset($this->student) ? $this->student["phone_number"] : "" ?>">
        </div>
        <div class="col-12 form-floating mt-3">
            <?= ($alert) ? "<div class='alert alert-$alert[type] role='alert'>$alert[text]</div>" : "" ?>
        </div>
        <div class="col-12 form-floating mt-3">
            <button class="btn btn-primary" type="submit">Submit</button>
            <button class="btn btn-secondary" onclick="">Return</button>
        </div>
    </div>
</form>

<?php require 'views/footer.php' ?>