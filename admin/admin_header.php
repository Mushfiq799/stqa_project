<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Online News Portal</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark " style=" background-color:#24262b;">
        <div class="container-fluid">

            <a class="navbar-brand" href="./admin_dashboard.php">Admin Panel</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/online_news_portal/admin/admin_dashboard.php">News
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/online_news_portal/admin/admin_category.php">Category
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/online_news_portal/admin/all_users.php">Reader
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/online_news_portal/main.php">Return To Home </a>
                    </li>
                    <li class="nav-item">
                        <form action="/online_news_portal/logout.php" method="POST">
                            <button type="submit" name="logout_btn" class="btn btn-small btn-info">Logout</button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>