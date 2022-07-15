<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php

    //* use data from the delete form to prime the following database operation

    if(isset($_POST['delete']) && !empty($_POST['delete'])) {

        // get data from grave delete form (graveID and imageName)
        // your code here

        $query = "delete from graves where graveID = $placeholder";//! placeholder
        mysqli_query($connection, $query);

        if(mysqli_error($connection)) {

            // Failure
            setMessage("Grave deletion failed. error message: " . mysqli_error());
            redirect_to("graves.php");

        } else {

            // if data successfully removed from database, delete image from uploads folder
            unlink("assets/img/uploads/{$placeholder}");//! placeholder

            // Success
            setMessage("Grave deleted successfully.");
            redirect_to("graves.php");
        }

    } else {

        setMessage("Delete unsuccessful. Please contact you site administrator.");
        redirect_to("graves.php");

    }

?>
