<?php
include_once 'header.php';
?>
<section class="signup-form">
    <br>

    <div class="container">
        <h2>Sign Up Form</h2>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="user_firstname" placeholder="First name"> <br>
            <input type="text" name="user_lastname" placeholder="Last name"> <br>
            <input type="text" name="user_email" placeholder="Email"> <br>
            <input type="text" name="user_contact_number" placeholder="Contact Number"> <br>
            <input type="text" name="user_address" placeholder="Address"> <br>
            <input type="password" name="user_password" placeholder="Password"> <br>
            <input type="password" name="user_password_repeat" placeholder="Repeat Password">
            <br>
            <br>
            <button class="btn btn-danger" type="submit" name="signup_btn">Sign Up</button>
            <br>
            <br>
        </form>
    </div>
</section>


<?php
include_once 'footer.php';
?>