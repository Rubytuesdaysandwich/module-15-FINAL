<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php

    $username = $_POST['username'];
    $password = $_POST['password'];

    // try to log in assuming user and password are correct
    function attempt_login($username, $password) {
        $user = find_user_by_username($username);

        if($user) {
            // found user, now check password
            if(password_check($password, $user['password'])) {
                // Remove password field from array
                unset($user['password']);
                // password matches, now get return the user
                return $user;
            } else {
                // password does not match
                return false;
            }
        } else {
            // user not found
            return false;
        }
    }

    // part 2
    // was user successfully logged in?
    if(attempt_login($username, $password)) {
        // user successfully logged in
        // Mark user as logged in using session value
        // you can use other code to find out what this session value should be called
        $placeholder = true;//! placeholder
        redirect_to('graves.php');
    } else {
        // Failure to log in given user (username or password incorrect)
        setLoginMessage("Username/password not found.");
        redirect_to('index.php#openModal');
    }


