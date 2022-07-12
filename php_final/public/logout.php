<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
    // v1: simple logout
    // session_start();
    unset($_SESSION['loggedIn']);
    redirect_to("index.php");
?>
