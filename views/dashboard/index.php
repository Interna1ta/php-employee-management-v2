<?php
// require_once("./library/loginManager.php");

// checkSession();
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
            <div id="jsGrid"></div>
        </main>
    </div>
</div>

<?php require 'views/footer.php' ?>