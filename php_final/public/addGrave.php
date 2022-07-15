
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
    // did we get a file to upload?
    if (isset($_POST['addGrave'])) {

        $target_dir = "assets/img/uploads/";
        $imageName = basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $imageName;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $tempFile = $_FILES["fileToUpload"]["tmp_name"];

        $uploadOk = 1;

        $error = [];
        
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $error[] = "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $error[] = "File is not an image.";
                $uploadOk = 0;
            }
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
            // try to upload it
            if(move_uploaded_file($tempFile, $target_file)) { 
                //* if image upload successful, attempt database operations
                //* use data from the form to make the following database operations work
                // your code here
                $grave = array_map('mysql_prep', $_POST);

                //* format dates for the database
                // $birthDate = date('Y-m-d', strtotime(***Put birthdate from form here***));
                // $deathDate = date('Y-m-d', strtotime(***Put birthdate from form here***));
                //! placeholder 
                //* insert steps               
                $query = "insert into graves (firstName, middleName, lastName, birthDate, deathDate, imageName) values(\"". $placeholder ."\", \"". $placeholder ."\", \"". $placeholder ."\", \"". $placeholder ."\", \"". $placeholder ."\", \"". $placeholder ."\")";
//! placeholder
                // run the query
                mysqli_query($connection, $query);
                
                //* test for mysql error (myd) and output message to graves page either way
                //* if database query fails, delete image file from the uploads folder
                if (mysqli_error($connection) == '') {
                    // Success on data getting into database
                    setMessage("Grave added successfully.");
                    redirect_to("graves.php");
                } else {
                    // Failure on data getting into database
                    setMessage("We could not add the grave. Something is wrong with the submitted information.");

                    // if data was NOT successfully inserted into database, delete image from uploads folder
                    unlink("assets/img/uploads/$imageName");
                    
                    redirect_to("graves.php");
                }

            } else {
                // Failure on upload function
                setMessage("We could not add the grave. Something went wrong with the upload.");
                redirect_to("graves.php");
            }
        } else { // failure to pass image checks
            setMessage("We could not add the grave. Something is wrong with the image you tried to upload. <br>");
            redirect_to("graves.php");
        }
    } else {
        // if no file was given
        setMessage("Please add a grave");
        redirect_to("graves.php");
    }
?>
