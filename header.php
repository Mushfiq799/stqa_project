<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/online_news_portal/css/style.css">
    <title>Online News Portal</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark " style=" background-color:#24262b;">
        <div class="container-fluid">

            <a class="navbar-brand" href="/online_news_portal/main.php">Online News Portal</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/online_news_portal/main.php">Home</a>
                    </li>

                    <?php
                    session_start();
                    if (isset($_SESSION["user_id"]) && isset($_SESSION["user_role"])) {
                        if ($_SESSION["user_role"] == "admin") {
                    ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/online_news_portal/admin/admin_dashboard.php">Admin Dashboard</a>
                            </li>
                        <?php } else { ?>

                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/online_news_portal/user/user_dashboard.php">User Dashboard</a>
                            </li>
                        <?php }
                    } else {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/online_news_portal/signup.php">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/online_news_portal/login.php">Log In</a>
                        </li>
                    <?php } ?>

                </ul>

            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-dark " style=" background-color:#24262b;">
        <div class="container-fluid">


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php


                    $serverName = 'localhost';
                    $dbName = 'online_news_portal';
                    $userName = 'root';
                    $password = '';

                    /**connecting to the database */
                    $conn = mysqli_connect($serverName, $userName, $password, $dbName);
                    if (!$conn) {
                        die("Database Connection Failed : " . mysqli_connect_error());
                    }

                    $sql = "SELECT category_id, category_name,upload_date, admin_id	
                    FROM category";
                    $result = mysqli_query($conn, $sql);

                    $categoryInfo = array();
                    if ($result->num_rows > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {
                            $category = array('category_id' => $row['category_id'], 'category_name' => $row['category_name'], 'upload_date' => $row['upload_date'], 'admin_id' => $row['admin_id']);

                            array_push($categoryInfo, $category);
                        }
                    }

                    foreach ($categoryInfo as $category) {


                    ?>
                        <form action="/online_news_portal/news/category_news_page.php" method="POST">
                            <input type="text" name="category_id" hidden value="<?php echo $category["category_id"]; ?>">
                            <input type="text" name="category_name" hidden value="<?php echo $category["category_name"]; ?>">
                            <button type="submit" name="category_news_btn" style="border: 1px solid white; margin-right: 5px; padding:5px; background-color:#24262b; color:white">
                                <?php echo  $category["category_name"] ?>
                            </button>
                        </form>
                    <?php } ?>


                </ul>

            </div>
        </div>
    </nav>