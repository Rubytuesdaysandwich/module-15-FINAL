<?php

    /*----------- helper functions -----------------*/

    // redirect to given page
    function redirect_to($new_page) {
        header("Location: $new_page");
        exit;
    }

    // did the query come back with an error?
    function confirm_query($result_set) {
        if(!$result_set){
            die("Database query failed: " . mysqli_connect_error());
        }
    }

    // sanitize form input for mysql queries
    function mysql_prep($string) {
        global $connection;

        $escaped_string = mysqli_real_escape_string($connection, $string);
        return $escaped_string;
    }

    // part 1
    // get all graves from the database
    function find_all_graves() {
        global $connection;

        // Build and perform database query
        $query = "select * from graves";
        $results = mysqli_query($connection, $query);
        // Test if there was a query error

        return $results;
    }

    // part 3
    // get the current grave from its Id
    function find_grave_by_id($id) {
        global $connection;

        // use a query string database operation to get the grave by its id
        // you may want to return an associative array (mysqli_fetch_assoc())
        // this will most naturally be multiple lines of code
        // your code here
        $grave = "placeholder";

        return $grave;
    }

    // part 2
    // check if user still logged in
    function logged_in() {
        return isset($_SESSION['loggedIn']);
    }

    // part 2
    // check if user is logged in and make an error message if not
    function confirm_logged_in() {
        if(!logged_in()) {
            setLoginMessage("Please log in");
            redirect_to('index.php#openModal');
        }
    }

    // check if password given from the login form matches the current user's password hash from the database
    function password_check($password, $existing_hash) {
        // existing hash contains format and salt at start
        $hash = crypt($password, $existing_hash);
        if ($hash === $existing_hash) {
            return true;
        } else {
            return false;
        }
    }

    // get the current user from the database using their username
    function find_user_by_username($username) {
        global $connection;

        /* Prepared statement, stage 1: prepare */
        if (!($stmt = mysqli_prepare($connection, "Select * FROM users WHERE username = ? LIMIT 1"))) {
            echo "Prepare failed: (" . mysqli_errno($connection) . ") " . mysqli_error($connection);
        }

        /* Prepared statement, stage 2: bind parameters */
        $stmt->bind_param( 's', $username );

        /* Prepared statement, stage 3: execute statement*/
        if(!$result = $stmt->execute()){
            return null;
        } else {
            //get result from previously executed statement - old $result variable no longer needed
            $result = mysqli_fetch_assoc($stmt->get_result());

            return $result;
        }
    }
?>