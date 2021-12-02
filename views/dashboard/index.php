<?php
require_once "controllers/dashboard.php";
require 'views/header.php';
?>

<div class="container-fluid">
    <div class="row">

        <main class="col-12 ms-sm-auto px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    Welcome <span class="text-primary"></span>
                </h1>
            </div>
            <div id="update-toast" class='update-toast toast align-items-center text-white bg-primary border-0 w-25 mx-auto my-5' role='alert' aria-live='assertive' aria-atomic='true'>
                <div class='d-flex'>
                    <div class='toast-body'>
                        <span class='text-center'>Student successfully updated.</span>
                    </div>
                </div>
            </div>
            <div id="delete-toast" class='delete-toast toast align-items-center text-white bg-primary border-0 w-25 mx-auto my-5' role='alert' aria-live='assertive' aria-atomic='true'>
                <div class='d-flex'>
                    <div class='toast-body'>
                        <span id='employee-deleted'>Student successfully deleted.</span>
                    </div>
                </div>
            </div>
            <div id="jsGrid"></div>
        </main>
    </div>
</div>

<?php require 'views/footer.php' ?>