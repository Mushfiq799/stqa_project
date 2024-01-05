<?php
if (isset($_POST["login_btn"])) {

    $user_email = $_POST["user_email"];
    $user_password = $_POST["user_password"];





    include_once "./dbh.inc.php";
    include_once "./functions.inc.php";

    loginUser($conn, $user_email, $user_password);
}
