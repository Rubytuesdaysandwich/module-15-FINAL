<?php include_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php include_once("../includes/functions.php"); ?>

<?php
    if(isset($_GET['page']) && !empty($_GET['page'])) {
        $page = $_GET['page'];
    }else {
        $page = null;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="Jeremiah Christensen">
        <title>The Grave Site</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="assets/css/styles.css" rel="stylesheet" type="text/css">
        <link href="assets/css/normalize.css" rel="stylesheet" type="text/css">
        <link href="assets/css/w3.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <div class="navbar">
                <nav>
                    <ul>
                        <li <?php if($page == "home"){ echo "class=\"selected\" "; }?>>
                            <a href="index.php?page=home">Home</a>
                        </li>
                        <li <?php if($page == "about"){ echo  "class=\"selected\" "; }?>>
                            <a href="about.php?page=about">About</a>
                        </li>
                        <li <?php if($page == "faq"){ echo "class=\"selected\" "; }?>>
                            <a href="faq.php?page=faq">FAQ</a>
                        </li>
                        <li <?php if($page == "blog"){ echo "class=\"selected\" "; }?>>
                            <a href="blog.php?page=blog">Blog</a>
                        </li>
                        <li <?php if($page == "contact"){ echo "class=\"selected\" "; }?>>
                            <a href="contact.php?page=contact">Contact</a>
                        </li><?php 

                        if(logged_in()){ ?>

                        <li <?php if($page == "graves"){ echo "class=\"selected\" "; }?>>
                            <a href="graves.php?page=graves">Graves</a>
                        </li>
                        
                        <li><a href="logout.php">Logout</a></li><?php

                        } else { ?>

                        <li><a href="#openModal">Login</a></li><?php
                        
                        }?>
                    </ul>
                </nav>
            </div><!-- end navbar -->
            <div id="openModal" class="modalDialog">
                <div>
                    <a href="#close" title="Close" class="close">X</a>
                        <!-- Content for modal -->
                        <div class="login">
                            <h2>Sign in</h2>
                            <?php echo message("loginMessage"); ?>
                            <form action="login.php" method="POST">
                                <input type="text" name="username" placeholder="Username">//! placeholder
                                <input type="password" name="password" placeholder="Password">//! placeholder
                                <input type="submit" name="login" value="Login">
                            </form>
                        </div><!-- end login -->
                </div><!-- end close -->
            </div><!-- end openModal -->
        </header>