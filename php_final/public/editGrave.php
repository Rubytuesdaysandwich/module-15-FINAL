<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php

    // if there is an image to upload (update with), process it
    if(isset($_FILES["fileToUpload"]["name"]) && !empty($_FILES["fileToUpload"]["name"])) {

        $hasNewImage = true;
        $target_dir = "assets/img/uploads/";
        $imageName = basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $imageName;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $tempFile = $_FILES["fileToUpload"]["tmp_name"];

        $uploadOk = 1;

        $error = [];
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $error[] = "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $error[] = "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $error[] = "file already exists";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 50000000) {
            $error = "file too large";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $error[] = "file type: $imageFileType not supported";
            $uploadOk = 0;
        }

        // if the image is ok...
        if ($uploadOk) {

            // if image is good to be updated, delete old image from uploads folder
            unlink("assets/img/uploads/{$_POST['originalImage']}");

            // attempt to upload new image
            if(move_uploaded_file($tempFile, $target_file)) {

                // apply mysqli_real_escape_string to all entries of $_POST array
                $queryInfo = array_map('mysql_prep', $_POST);

                // format date for the database
                $birthDate = date('Y-m-d', strtotime($placeholder));//! placeholder
                $deathDate = date('Y-m-d', strtotime($placeholder));//! placeholder
//! placeholder
                //* insert steps for attempting image update               
                $query = "update graves set firstName = \"". $placeholder ."\", middleName = \"". $placeholder ."\", lastName = \"". $placeholder ."\", birthDate = \"". $placeholder ."\", deathDate = \"". $placeholder ."\", imageName = \"". $placeholder ."\" where graveID = ". $placeholder;
//! placeholder
                // uncomment the line below to see the query before it gets executed
                // echo $query; exit;

                // run the query
                mysqli_query($connection, $query);
                
                //* test for mysql error and output message to graves page either way
                //* if database query fails, delete image file from the uploads folder
                if (mysqli_error($connection) == '') {
                    // Success on data getting into database
                    setMessage("Grave updated successfully.");
                    redirect_to("graves.php");
                } else {

                    // if data was NOT successfully updated while image update attempted, delete image from uploads folder
                    unlink("assets/img/uploads/$imageName");

                    // Failure on data getting into database
                    setMessage("The grave could not be updated. error: " . mysqli_error($connection));
                    redirect_to("graves.php");
                }
            }
        
        } else {
            // Failure on image checks
            setMessage("The grave could not be updated. There was an issue with the image file you were trying to upload.");
            redirect_to("graves.php");
        }
    } else { // if not updating the image

        // apply mysqli_real_escape_string to all entries of $_POST array
        $queryInfo = array_map('mysql_prep', $_POST);

        // format date for the database
        $birthDate = date('Y-m-d', strtotime($placeholder));//! placeholder
        $deathDate = date('Y-m-d', strtotime($placeholder));//! placeholder
//! placeholder
        //* insert steps without attempting image update               
        $query = "update graves set firstName = \"". $placeholder ."\", middleName = \"". $placeholder ."\", lastName = \"". $placeholder ."\", birthDate = \"". $placeholder ."\", deathDate = \"". $placeholder ."\" where graveID = ". $placeholder;
//! placeholder
        // uncomment the line below to see the query before it gets executed
        // echo $query; exit;

        // run the query
        mysqli_query($connection, $query);
        
        //* test for mysql error and output message to graves page either way
        //* if database query fails, delete image file from the uploads folder
        if (mysqli_error($connection) == '') {

            // Success on data getting into database
            setMessage("Grave updated successfully.");
            redirect_to("graves.php");

        } else {

            // Failure on data getting into database
            setMessage("The grave could not be updated. error: " . mysqli_error($connection));
            redirect_to("graves.php");
        }

    }
?>
