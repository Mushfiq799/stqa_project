<?php
include_once "./header.php";
include_once "./includes/dbh.inc.php";
include_once "./includes/functions.inc.php";


$newsInfo = getAllNews($conn);

?>

<main style="height:1000px">



    <div class="banner mt-3">
        <img src="/online_news_portal/img/cover.jpg" alt="" width="100%" height="100%">


    </div>

    <div class="product-card container mb-5 mt-2" id="product-card">
        <div class="row row-cols-1 row-cols-md-4 g-4 mt-2">
            <?php foreach ($newsInfo as $news) {
                $id = $news["news_id"]; ?>
                <div class="col-4">
                    <div class=" card">
                        <img src="/online_news_portal/img/news_img/<?= $news["news_img_1"] ?>" class="card-img-top" style=" height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <form action="/online_news_portal/news/single_news_page.php" method="GET">
                                <input type="text" name="news_id" hidden value="<?php echo $id ?>">
                                <button type="submit" name="see_news" style="background: white; border: none;">
                                    <h6><b><?php echo  $news["news_header"] ?></b></h6>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>


</main>

<?php
//include_once "./footer.php";

?>