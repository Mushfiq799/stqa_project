<?php
if (isset($_POST["edit_reader"])) {


    $reader_id = $_POST["user_id"];
    $reader_firstname = $_POST["user_firstname"];
    $reader_lastname = $_POST["user_lastname"];
    $reader_email = $_POST["user_email"];
    $reader_address = $_POST["user_address"];
    $reader_contact_number = $_POST["user_contact_number"];
    $reader_password = $_POST["user_password"];
    $reader_password_repeat = $_POST["user_password_repeat"];

    include_once "../dbh.inc.php";
    include_once "../functions.inc.php";

    if ($reader_password ==  $reader_password_repeat) {

        editReaderInfo($conn, $reader_id, $reader_firstname, $reader_lastname, $reader_email, $reader_password, $reader_contact_number, $reader_address);
    } else {

        echo "incorrect";
    }
}
