<?php

if (isset($_POST["like_btn"]) || isset($_POST["fav_btn"])) {
    session_start();

    $news_id = $_POST["news_id"];
    $user_id = $_SESSION["user_id"];

    include_once '../dbh.inc.php';
    include_once '../functions.inc.php';

    $sql = "SELECT np_id from news_preference 
            WHERE news_id='$news_id' AND reader_id='$user_id'";

    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) == 0) {

        $sql = "INSERT INTO news_preference (news_id, reader_id,like_field,fav_field)
        VALUES ('$news_id','$user_id','0', '0')";
        $res = mysqli_query($conn, $sql);
    }



    if (isset($_POST["like_btn"])) {


        $like = 1;

        $sql = "UPDATE news_preference
                    SET like_field = '$like'
                    WHERE news_id='$news_id' AND reader_id='$user_id' ";
        $res = mysqli_query($conn, $sql);
        if ($res) {

            echo "<script>
            alert('Added To Liked News');
            window.location.href='/online_news_portal/main.php';
            </script>";
        } else {
            echo "Like not ok";
        }
    } else {


        $fav = 1;
        $sql = "UPDATE news_preference
                    SET fav_field = '$fav'
                    WHERE news_id='$news_id' AND reader_id='$user_id' ";
        $res = mysqli_query($conn, $sql);
        if ($res) {

            echo "<script>
            alert('Added To Favourite News');
            window.location.href='/online_news_portal/main.php';
            </script>";
        } else {
            echo "Fav not ok";
        }
    }
}
