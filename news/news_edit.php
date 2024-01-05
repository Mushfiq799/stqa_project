<?php


if (isset($_POST["news_edit_btn"])) {
    include_once "../header.php";
    include_once "../includes/dbh.inc.php";
    include_once "../includes/functions.inc.php";

    $newsId = $_POST['news_id'];

    $newsInfo = singleNews($conn, $newsId);
    $newsCategory = getSingleCategory($conn, $newsInfo["category_id"]);





?>
    <main style="height:1700px">
        <div class="container">
            <a class="btn btn-info mt-3" href="/online_news_portal/admin/admin_news.php">All News</a>
            <h4 class="mt-3">Edit News Form</h4>
            <form action="/online_news_portal/includes/news_inc/news_edit_inc.php" method="POST" enctype="multipart/form-data">
                <input hidden type="text" name="uploader_id" value="<?php echo $_SESSION["user_id"] ?>">
                <input hidden type="text" name="news_id" value="<?php echo $newsInfo["news_id"] ?>">
                <input hidden type="text" name="news_img_1" value="<?php echo $newsInfo["news_img_1"] ?>">

                <!-- <div class="mb-3 mt-3">
                    <h6>Previous Category: <?php echo $newsCategory["category_name"]; ?></h6>
                    <h6>Select New Category </h6>
                    <select name="category_id">
                        <?php
                        foreach ($categoryInfo as $category) {

                        ?>
                            <option id="category"><?php echo $category['category_id'] . " - " . $category['category_name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>

                </div> -->
                <div class="mb-3">
                    <h5>Previous Image</h5>
                    <img src="/online_news_portal/img/news_img/<?= $newsInfo["news_img_1"] ?>" class="card-img-top" style="height:400px">
                </div class="mb-3">
                <div class="mb-3">
                    <label class="form-label"></label><br>
                    <img width="600" height="200" class="img-thumbnail" alt="" id="news-image-1">
                    <input type="file" name="news_img_1" accept="image/png, image/jpg, image/jpeg" onchange='loadImage(event)' />
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" name="news_header" style="height: 70px"><?php echo $newsInfo["news_header"]  ?></textarea>
                        <label for="floatingTextarea2">Headline</label>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" name="news_body" style="height: 1000px"><?php echo $newsInfo["news_body"]  ?></textarea>
                        <label for="floatingTextarea2">News Description</label>
                    </div>
                </div>
                <div class="mb-5">
                    <input type="submit" value="Save As" class="btn btn-primary" name="edit_news"><br>
                </div>
            </form>
        </div>
        <script>
            var loadImage = function(event) {

                if (event.target.name == 'news_img_1') {
                    let image1 = document.getElementById('news-image-1');
                    image1.src = URL.createObjectURL(event.target.files[0]);
                }

            };
        </script>



    <?php
}
//include_once "./footer.php";

    ?>