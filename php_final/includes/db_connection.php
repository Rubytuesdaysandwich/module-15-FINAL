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
?>
