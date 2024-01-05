<?php
include_once 'header.php';
?>

<div class="container-lg">
    <section class="signup-form">
        <br>
        <h2>Log In Form</h2>
        <form action="includes/login.inc.php" method="post">

            <input type="text" name="user_email" placeholder="Enter your Email"> <br>
            <input type="password" name="user_password" placeholder="Enter your Password">
            <br>
            <br>
            <button type="submit" class="btn btn-danger" name="login_btn">LOG IN PLEASE</button>
            <br>
            <br>
        </form>
    </section>
</div>