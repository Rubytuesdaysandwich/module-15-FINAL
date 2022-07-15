<?php
$public = true;
include("../includes/layouts/header.php");
?>
        <!-- =============== Hero =============== -->

        <section class="hero" id="contact-hero"></section><!-- end hero -->
        <section class="section">
            <h2 class="section-header">Contact Us</h2>
            <div class="contact-us">
                <h3>Send us a message and we will get back to you as soon as we can.</h3>
                <div class="form-box">
                    <form class="contact-form" action="processContact.php" method="post">
                        <div class="w3-row">
                            <div class="w3-half">
                                <input type="text" name="fullName" placeholder="Full Name">//! placeholder
                                <input type="text" name="subject" placeholder="Subject">//! placeholder
                            </div>
                            <div class="w3-half">
                                <input type="text" name="phone" placeholder="Phone Number">//! placeholder
                                <input type="email" name="email" placeholder="Email Address">//! placeholder
                            </div>
                        </div>
                        <div class="message-box">
                            <label for="message">Message</label>
                            <textarea id="message" name="messageText"></textarea>
                        </div>
                        <input type="submit" class="contact pull-right" name="contactUs" value="Submit">
                    </form>
                </div>
            </div>
        </section>

<?php include("../includes/layouts/footer.php"); ?>
