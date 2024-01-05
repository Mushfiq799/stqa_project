<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != "admin") {
    header('location:/online_news_portal/main.php');
    exit();
}

include_once "./admin_header.php";
include_once "../includes/dbh.inc.php";
include_once "../includes/functions.inc.php";

$categoryInfo = getAllCategory($conn);

?>
<main style="height:1700px">
    <div class="container">
        <a class="btn btn-info mt-3" href="/online_news_portal/admin/admin_news.php">All News</a>
        <h4 class="mt-3">News Form</h4>
        <form action="/online_news_portal/includes/admin_inc/admin_upload_news_inc.php" method="POST" enctype="multipart/form-data">
            <input hidden type="text" name="uploader_id" value="<?php echo $_SESSION["user_id"] ?>">

            <div class="mb-3 mt-3">

                <select name="category_id">
                    <?php
                    foreach ($categoryInfo as $category) {

                    ?>
                        <option id="category"><?php echo $category['category_id'] . " - " . $category['category_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <label class="form-label">News Category </label>
            </div>
            <div class="mb-3">
                <label class="form-label"></label><br>
                <img width="600" height="200" class="img-thumbnail" alt="" id="news-image-1">
                <input type="file" name="news_img_1" accept="image/png, image/jpg, image/jpeg" onchange='loadImage(event)' />
            </div>

            <div class="mb-3">
                <div class="form-floating">
                    <textarea class="form-control" name="news_header" style="height: 70px"></textarea>
                    <label for="floatingTextarea2">Headline</label>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-floating">
                    <textarea class="form-control" name="news_body" style="height: 1000px"></textarea>
                    <label for="floatingTextarea2">News Description</label>
                </div>
            </div>
            <div class="mb-5">
                <input type="submit" value="Upload" class="btn btn-primary" name="upload_news"><br>
            </div>
        </form>
    </div>
    <script>
        var loadImage = function(event) {

            if (event.target.name == 'news_img_1') {
                let image1 = document.getElementById('news-image-1');
                image1.src = URL.createObjectURL(event.target.files[0]);
            } else {
                let image2 = document.getElementById('news-image-2');
                image2.src = URL.createObjectURL(event.target.files[0]);

            }

        };
    </script>





</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>