
<?php

if (isset($_POST["add_category"])) {

    $category_name = $_POST["category_name"];



    $admin_id = $_POST["admin_id"];


    include_once '../dbh.inc.php';
    include_once '../functions.inc.php';

    $currentDate = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $upload_date =  $currentDate->format('Y/m/d');
    addCategory($conn, $category_name, $upload_date, $admin_id);
}
