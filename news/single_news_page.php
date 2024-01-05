<?php

include_once "../header.php";
if (isset($_GET['see_news'])) {

    $news_id = $_GET["news_id"];

    include_once "../includes/dbh.inc.php";
    include_once "../includes/functions.inc.php";

    $newsInfo = singleNews($conn, $news_id);

    $likeFavCount = getLikeFavCount($conn, $news_id);



?>
    <div class="single-news-page container">
        <div class="card mb-3">
            <img src="/online_news_portal/img/news_img/<?= $newsInfo["news_img_1"] ?>" class="card-img-top" style="height:400px">
            <div class="card-body">
                <b><span> Upload Date: <?php echo $newsInfo["upload_date"] ?></span> </b>
                <b><span> Upload Time: <?php $time = explode(" ", $newsInfo["upload_time"]);
                                        echo $time[1]; ?></span></b>
                <br> <br>

                <h3 class="card-title"><?php echo $newsInfo["news_header"] ?></h5>
                    <p style="white-space: pre-line"><?php echo  $newsInfo["news_body"] ?></p>
            </div>

        </div>

        <div class="like-section">
            <b><span>Like : <?php echo $likeFavCount["like_count"] ?></span> </b>
            <b><span>Favourite : <?php echo $likeFavCount["fav_count"] ?></span> </b>

            <div class="mb-3">
                <?php
                if (isset($_SESSION["user_id"]) && isset($_SESSION["user_role"])) {

                    if ($_SESSION["user_role"] == "reader") {
                ?>
                        <form action="/online_news_portal/includes/news_inc/single_news_inc.php" method="POST">
                            <input type="text" hidden name="news_id" value="<?php echo  $news_id ?>">
                            <button type="submit" name="like_btn" class="btn btn-primary">LIKE</button>
                            <button type="submit" name="fav_btn" class="btn btn-success">Add to Favourite</button>
                        </form>
                    <?php } else { ?>

                        <form action="/online_news_portal/news/news_edit.php" method="POST">
                            <input type="text" hidden name="news_id" value="<?php echo  $news_id ?>">
                            <button type="submit" name="news_edit_btn" class="btn btn-primary">EDIT NEWS</button>
                        </form>

                    <?php }
                } else { ?>
                    <p class="text-center">Please Log in to react!</p>

                    <form action="../includes/login.inc.php" method="post">

                        <input type="text" name="user_email" placeholder="Enter your Email"> <br>
                        <input type="password" name="user_password" placeholder="Enter your Password"> <br>
                        <button type="submit" class="btn btn-danger" name="login_btn">Log In</button>
                        <br>
                        <br>
                    </form>

                <?php
                } ?>

            </div>

        </div>
    </div>

<?php } ?>