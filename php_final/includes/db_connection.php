<?php
    // Create database connection

    define("DB_SERVER", "localhost");
    define("DB_USER", "gravesUser");
    define("DB_PASS", "localPass");
    define("DB_NAME", "graves");

    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    // Test if connection attempt was successful
    if(mysqli_connect_errno()){
        die("Database connection failed: " . mysqli_connect_error());
    }
    function confirm_result_set($result_set) {
        if (!$result_set) {//if we don't get back a data set
            exit("Database query failed.");//if database query fails then exit
        }
    }
 ?>
