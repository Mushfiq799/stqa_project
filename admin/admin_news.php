<?php
session_start();

if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == "admin") {

    include_once "./admin_header.php";
    include_once '../includes/dbh.inc.php';
    include_once '../includes/functions.inc.php';
    $adminNewsInfo = getAdminNews($conn, $_SESSION['user_id']);

?>

    <main style="height:1700px">
        <div class="container mb-5 mt-2" id="">
            <a class="btn btn-info mt-3" href="/online_news_portal/admin/admin_dashboard.php">News Form</a>

            <div class="row row-cols-1 row-cols-md-4 g-4 mt-2">
                <?php foreach ($adminNewsInfo as $news) {
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


        </div>
    </main>
<?php } else {
    header('location:/online_news_portal/login.php');
} ?>