<?php include_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php include_once("../includes/functions.php"); ?>
<?php confirm_logged_in();//confirm loggedin functions.php ?>

<?php include("../includes/layouts/header.php"); ?>

<?php 
    $graves = find_all_graves(); // finish this function in includes/functions.php

?>

<!-- =============== Graves Heading =============== -->

<section class="section">
    <h1 class="section-header uncenter">Graves</h1>
</section><!-- end graves heading section -->

<!-- =============== List of graves =============== -->

<!-- part 3 -->
<div class="graves-box">
    <?php echo message(); ?>
    <section class="section">
        <table class="graves-table">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Birth Date</th>
                <th>Death Date</th>
            </tr>
            <?php foreach($graves as $grave) { ?>
            <tr>
                <td><img src="assets/img/uploads/<?php echo $grave['imageName']; ?>" alt=""></td>
                <td><?php echo $grave['firstName'] . " " . $grave['middleName'] . " " . $grave['lastName']; ?></td>
                <td><?php echo date('F j, Y', strtotime($grave['birthDate'])); ?></td>
                <td><?php echo date('F j, Y', strtotime($grave['deathDate'])); ?></td>
                <td class="table-button-box">
                    <form class="table-button" action="#editGraveModal" method="post">
                        <!-- pass the graveID to the modal so I can use it to look up values up and fill the form -->
                        <input type="hidden" name="graveID" value="<?php echo $grave['graveID'] ?>">
                        <input type="submit" name="edit" value="Edit">
                    </form>
                </td>
                <td class="table-button-box table-button-box-right">
                    <form class="table-button" action="deleteGrave.php" method="post">
                        <input type="hidden" name="graveID" value="<?php echo $grave['graveID'] ?>">
                        <input type="hidden" name="imageName" value="<?php echo $grave['imageName'] ?>">
                        <input type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this grave?')" value="Delete">
                    </form>
                </td>
            </tr><?php
            } ?>
        </table>
        <a href="#addGraveModal">Add a Grave</a>
        <div id="addGraveModal" class="modalDialog graveModalDialog">
            <div><a href="#close" title="Close" class="close">X</a>
                <!-- Content for modal -->
                <div class="modal-header">
                    <h2>Add Grave</h2>
                </div>
                <div class="login Grave">
                    <?php echo message(); ?>
                    <form action="addGrave.php"  method="POST" enctype="multipart/form-data">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" id="firstName">
                        <label for="middleName">Middle Name</label>
                        <input type="text" name="middleName" id="middleName">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" id="lastName">
                        <label for="birthDate">Birth Date</label>
                        <input type="date" name="birthDate" id="birthDate" placeholder="November 14, 1986">//! placeholder
                        <label for="deathDate">Death Date</label>
                        <input type="date" name="deathDate" id="deathDate" placeholder="November 14, 2186">//! placeholder
                        <label for="fileToUpload">Grave Image</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" >
                        <input type="submit" name="addGrave" value="Add Grave">
                    </form>
                </div><!-- end login Grave -->
            </div><!-- end close -->
        </div><!-- end openModal -->
        <div id="editGraveModal" class="modalDialog graveModalDialog">
            <?php
            if(isset($_POST['graveID']) && !empty($_POST['graveID'])){ ?>
                <?php 
                    $grave = find_grave_by_id($_POST['graveID']); // finish this function in includes/functions.php
                ?>
                <div><a href="#close" title="Close" class="close">X</a>
                    <!-- Content for modal -->
                    <div class="modal-header">
                        <h2>Edit Grave</h2>
                    </div>
                    <div class="login Grave scroll">
                        <?php echo message(); ?>
                        <form action="editGrave.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="graveID" value="<?php echo $grave['graveID']; ?>"> <!-- hint -->//! hint
                            <label for="firstName">First Name</label>
                            <input type="text" name="firstName" id="firstName" value="grave first name value">
                            <label for="middleName">Middle Name</label>
                            <input type="text" name="middleName" id="middleName" value="grave middle name value">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="lastName" id="lastName" value="some grave value based on the name attribute">
                            <label for="birthDate">Birth Date</label>
                            <input type="date" name="birthDate" id="birthDate" value="<?php echo date('Y-m-d', strtotime("some grave value based on the name attribute")); ?>">
                            <label for="deathDate">Death Date</label>
                            <input type="date" name="deathDate" id="deathDate" value="<?php echo date('Y-m-d', strtotime("some grave value based on the name attribute")); ?>">
                            <label for="fileToUpload">Grave Image</label><br>
                            <img class="editImage" src="assets/img/uploads/<?php echo "current grave image name"; ?>" alt="Grave headstone">
                            <input type="hidden" name="originalImage" value="<?php echo "current grave image name"; ?>" >
                            <input type="file" name="fileToUpload" id="fileToUpload" >
                            <input type="submit" name="editGrave" value="Save Changes">
                        </form>
                        <a class="button" href="graves.php">Cancel</a>
                    </div><!-- end login Grave -->
                </div><!-- end close --><?php
            }?>
        </div><!-- end openModal -->
    </section><!-- end graves section-->
</div>
