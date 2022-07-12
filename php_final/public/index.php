<?php // hint: find_all_graves() in includes/functions.php ?>

<?php include("../includes/layouts/header.php"); ?>

        <!-- =============== Hero =============== -->

        <div id="home-hero">
            <div class="hero-text">
                <h1>Welcome to the Grave Site</h1>
                <p>A "clone" of the popular family history site <a href="https://www.findagrave.com/" target="_blank">Find a Grave</a></p>
            </div><!-- end hero-text -->
        </div><!-- end hero -->

        <!-- =============== Description =============== -->

        <section id="description">
            <h2>Graves</h2>
        </section><!-- end description -->

        <!-- show all graves in a table using data from database -->
        <table class="graves-table">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Birth Date</th>
                <th>Death Date</th>
            </tr>
            <!-- start some kind of loop -->
            <tr>
                <td>grave image from uploads folder and database data</td>
                <td>grave name from database data (first middle last)</td>
                <td>grave Birth Date from database data</td>
                <td>grave Death Date from database data</td>
            </tr>
            <!-- end some kind of loop -->
        </table><!-- end graves-table -->

<?php include("../includes/layouts/footer.php"); ?>
