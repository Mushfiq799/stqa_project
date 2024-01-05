<?php
if (isset($_POST['logout_btn'])) {
    session_start();
    unset($_SESSION['user_id']);
    unset($_SESSION['user_role']);
    session_destroy();
}

header('location:/online_news_portal/main.php');
