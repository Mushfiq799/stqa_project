<?php
if (isset($_POST["upload_news"]) && isset($_FILES['news_img_1'])) {

    include_once '../dbh.inc.php';
    include_once '../functions.inc.php';
    $uploder_id = $_POST['uploader_id'];
    $news_header = $_POST["news_header"];
    $cat_id = $_POST["category_id"];
    $cat_id = explode(" - ", $cat_id);


    $news_header = mysqli_real_escape_string($conn, $_POST["news_header"]);
    $news_body = mysqli_real_escape_string($conn, $_POST["news_body"]);


    $currentDate = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $upload_date =  $currentDate->format('Y/m/d');
    $news_img_1 = compressImage($_FILES['news_img_1']);

    $category_id = $cat_id[0];

    uploadNews($conn, $news_body, $news_header, $upload_date, $news_img_1, $uploder_id, $category_id);
}
