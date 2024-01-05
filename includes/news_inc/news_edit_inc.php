<?php

if (isset($_POST["edit_news"])) {
    include_once '../dbh.inc.php';
    include_once '../functions.inc.php';
    $news_id = $_POST["news_id"];
    $news_header = mysqli_real_escape_string($conn, $_POST["news_header"]);
    $news_body = mysqli_real_escape_string($conn, $_POST["news_body"]);


    if ($_FILES['news_img_1']["error"] == 0) {

        $news_img_1 = compressImage($_FILES['news_img_1']);
    } else {

        $news_img_1 = $_POST["news_img_1"];
    }



    updateNews($conn, $news_id, $news_header, $news_body, $news_img_1);
}
