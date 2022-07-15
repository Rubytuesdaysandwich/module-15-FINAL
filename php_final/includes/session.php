<?php

    session_start();

    // get needed message from the session
    function getMessage($type) {

        // check if a message of this type is saved in the session
        if(isset($_SESSION[$type])) {
            // save message into variable
            $message = htmlentities($_SESSION[$type]);

            // delete message from session so it can't be used more than once
            unset($_SESSION[$type]);
            return $message;
        }

        // return false if there is no message
        return false;
    }

    // this function is designed to handle multiple types of messages (login messages and grave form messages)
    function message($type = "graveMessage") {
        //!part 4--------------------------------------------------
        // remove this as part of your changes
        $_SESSION["dummy_value"] = "part 4 code needed here";
        $type = "dummy_value";

        // don't remove this
        $message = getMessage($type);

        if($message) {
            $output = "<div class=\"message\">";
            $output .= $message;
            $output .= "</div>";
        } else {
            $output = "";
        }

        return $output;
    }

    function setLoginMessage($message) {

        // create session variable to hold the login error message
        // "sessionVariable" = $message;
        // hint: Header.php line 68//! hint
    }

    function setMessage($message) {
        // create session variable to hold the most recent regular error/success message
        // "SessionVariable" = $message;
        // hint: session.php line 21//! hint
    }
?>
