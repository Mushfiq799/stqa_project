
<?php

function signupReader($conn, $reader_firstname, $reader_lastname, $reader_email, $reader_password, $reader_contact_number, $reader_address)
{

    $sql = "SELECT reader_email
            FROM reader 
            WHERE reader_email = '$reader_email'";

    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {

        echo "User already exists";
    } else {

        $sql = "INSERT INTO reader (reader_firstname,reader_lastname,reader_email,
        reader_password,reader_contact_number,reader_address)
        VALUES ('$reader_firstname','$reader_lastname','$reader_email','$reader_password','$reader_contact_number','$reader_address')";

        $res = mysqli_query($conn, $sql);

        if ($res) {
            echo "<script>
        alert('Sign Up Successfull');
        window.location.href='/online_news_portal/login.php';
        </script>";
        } else {

            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}



function loginUser($conn, $user_email, $user_password)
{

    session_start();
    $sql = "SELECT reader_id, reader_firstname,reader_lastname,reader_email,
            reader_password,reader_contact_number,reader_address
            FROM reader
            WHERE reader_email = '$user_email' ";

    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {

        while ($row = mysqli_fetch_assoc($res)) {

            $_SESSION["user_id"] = $row["reader_id"];
            $_SESSION["user_role"] = "reader";


            if ($row["reader_password"] == $user_password) {

                header("Location: ../main.php");
            } else {

                echo "Invalid credentials";
            }
        }
    } else {

        $sql = "SELECT admin_id,admin_firstname, admin_lastname, admin_email,admin_password,admin_contact_number,admin_address
        FROM admin
        WHERE admin_email = '$user_email' ";

        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {

            while ($row = mysqli_fetch_assoc($res)) {

                if ($row["admin_password"] == $user_password) {

                    #SETTING SESSION VALUE
                    $_SESSION["user_id"] = $row["admin_id"];
                    $_SESSION["user_role"] = "admin";


                    header("Location: ../admin/admin_dashboard.php");
                } else {

                    echo "Invalid credentials";
                }
            }
        }
    }
}


function uploadNews($conn, $news_body, $news_header, $upload_date, $news_img_1, $uploder_id, $category_id)
{


    $sql = "INSERT INTO news (news_header,news_body,upload_date,
    news_img_1,admin_id,category_id)
    VALUES ('$news_header','$news_body','$upload_date', '$news_img_1', '$uploder_id', '$category_id')";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo "<script>
        alert('News upload succesful');
        window.location.href='/online_news_portal/main.php';
        </script>";
    } else {

        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function compressImage($uploadImage)
{



    $img_name = $uploadImage['name'];
    $img_type = $uploadImage['type'];
    $tmp_name = $uploadImage['tmp_name'];
    $error = $uploadImage['error'];


    if ($error == 0) {

        if ($img_type == 'image/png') {
            $inputImg = imagecreatefrompng($tmp_name);
        } else {
            $inputImg = imagecreatefromjpeg($tmp_name);
        }


        if (isset($inputImg)) {

            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex); //png / jpg / jpeg
            $allowed_exs = array("jpg", "jpeg", "png");
            if (in_array($img_ex_lc, $allowed_exs)) {

                $imgId = uniqid('IMG-') . '.jpg';
                $outputImagePath = '../../img/news_img/' .  $imgId;

                imagejpeg($inputImg, $outputImagePath, 50);

                return $imgId;
            }
        }
    }
}

function getAllNews($conn)
{
    $sql = "SELECT news_id, news_body,news_header,upload_time,upload_date,
    news_img_1,admin_id,category_id	
    FROM news";
    $result = mysqli_query($conn, $sql);

    $newsInfo = array();
    if ($result->num_rows > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $news = array('news_id' => $row['news_id'], 'news_body' => $row['news_body'], 'news_header' => $row['news_header'], 'upload_time' => $row['upload_time'], 'upload_date' => $row['upload_date'], 'news_img_1' => $row['news_img_1'], 'admin_id' => $row['admin_id'], 'category_id' => $row['category_id']);

            array_push($newsInfo, $news);
        }
    }
    return  $newsInfo;
}

function singleNews($conn, $news_id)
{
    $sql = "SELECT news_id, news_body,news_header,upload_time,upload_date,
    news_img_1,admin_id,category_id	
            FROM news
            WHERE news_id = '$news_id'";

    $result = mysqli_query($conn, $sql);


    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $newsInfo = array('news_id' => $row['news_id'], 'news_body' => $row['news_body'], 'news_header' => $row['news_header'], 'upload_time' => $row['upload_time'], 'upload_date' => $row['upload_date'], 'news_img_1' => $row['news_img_1'], 'admin_id' => $row['admin_id'], 'category_id' => $row['category_id']);
        }
    }

    return  $newsInfo;
}

function getAllCategory($conn)
{


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
    return  $categoryInfo;
}

function getCategoryNews($conn, $category_id)
{
    $sql = "SELECT news_id, news_body,news_header,upload_time,upload_date,
    news_img_1,admin_id,category_id	
    FROM news
    WHERE category_id='$category_id'";
    $result = mysqli_query($conn, $sql);

    $newsInfo = array();
    if ($result->num_rows > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            $news = array('news_id' => $row['news_id'], 'news_body' => $row['news_body'], 'news_header' => $row['news_header'], 'upload_time' => $row['upload_time'], 'upload_date' => $row['upload_date'], 'news_img_1' => $row['news_img_1'], 'admin_id' => $row['admin_id'], 'category_id' => $row['category_id']);

            array_push($newsInfo, $news);
        }
    }


    return  $newsInfo;
}

function getAllReaderInfo($conn)
{

    $sql = "SELECT reader_id, reader_firstname,reader_lastname,reader_email,
            reader_password,reader_contact_number,reader_address
            FROM reader";

    $res = mysqli_query($conn, $sql);
    $readersInfo = array();
    if ($res->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $readerInfo = array('reader_id' => $row['reader_id'], 'reader_firstname' => $row['reader_firstname'], 'reader_lastname' => $row['reader_lastname'], 'reader_email' => $row['reader_email'], 'reader_pass' => $row['reader_password'], 'reader_contact_number' => $row['reader_contact_number'], 'reader_address' => $row['reader_address']);

            array_push($readersInfo, $readerInfo);
        }
    }




    return  $readersInfo;
}

function getAllViwerInfo($conn)
{

    $sql = "SELECT DISTINCT reader_id
            FROM news_preference";

    $res = mysqli_query($conn, $sql);
    $readersInfo = array();
    if ($res->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $readerInfo = array('reader_id' => $row['reader_id']);
            array_push($readersInfo, $readerInfo);
        }
    }

    return $readersInfo;
}

function getReaderInfo($conn, $reader_id)
{

    $sql = "SELECT reader_id, reader_firstname,reader_lastname,reader_email,
            reader_password,reader_contact_number,reader_address
    FROM reader
    WHERE reader_id = '$reader_id'";

    $res = mysqli_query($conn, $sql);

    if ($res->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $readerInfo = array('reader_id' => $row['reader_id'], 'reader_firstname' => $row['reader_firstname'], 'reader_lastname' => $row['reader_lastname'], 'reader_email' => $row['reader_email'], 'reader_pass' => $row['reader_password'], 'reader_contact_number' => $row['reader_contact_number'], 'reader_address' => $row['reader_address']);
        }
    }


    return  $readerInfo;
}


function  editReaderInfo($conn, $reader_id, $reader_firstname, $reader_lastname, $reader_email, $reader_password, $reader_contact_number, $reader_address)
{

    $sql = "UPDATE reader
            SET reader_firstname='$reader_firstname', reader_lastname='$reader_lastname', reader_email='$reader_email',reader_password='$reader_password',reader_contact_number='$reader_contact_number',reader_address='$reader_address'
            WHERE reader_id = '$reader_id'";

    $res = mysqli_query($conn, $sql);
    if ($res) {
        header("Location: ../../user/user_dashboard.php");
    } else {
        echo "Erorr";
    }
}

function updateNews($conn, $news_id, $news_Header, $news_Body, $news_img_1)
{
    // echo $news_id . "" .  $news_Header . "" .  $news_Body . "" . $news_img_1;
    // exit();
    $sql = "UPDATE news
    SET news_header='$news_Header', news_body='$news_Body', news_img_1='$news_img_1'
    WHERE news_id = '$news_id'";

    $res = mysqli_query($conn, $sql);
    if ($res) {
        header("Location: ../../admin/admin_news.php");
    } else {

        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


function getFavNews($conn, $reader_id)
{

    $sql = "SELECT news_id
            FROM news_preference
            WHERE reader_id= '$reader_id' AND fav_field='1'";
    $res = mysqli_query($conn, $sql);

    $favNewsInfo = array();
    if ($res->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($res)) {

            $favNews = singleNews($conn, $row["news_id"]);

            array_push($favNewsInfo, $favNews);
        }
    }

    return $favNewsInfo;
}

function getLikedNews($conn, $reader_id)
{

    $sql = "SELECT news_id
            FROM news_preference
            WHERE reader_id= '$reader_id' AND like_field='1'";
    $res = mysqli_query($conn, $sql);

    $likedNewsInfo = array();
    if ($res->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($res)) {

            $likedNews = singleNews($conn, $row["news_id"]);

            array_push($likedNewsInfo, $likedNews);
        }
    }

    return $likedNewsInfo;
}


function getAdminNews($conn, $admin_id)
{

    $sql = "SELECT news_id, news_body,news_header,upload_time,upload_date,
    news_img_1,admin_id,category_id	
    FROM news
    WHERE admin_id='$admin_id'";
    $result = mysqli_query($conn, $sql);

    $adminNewsInfo = array();
    if ($result->num_rows > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $news = array('news_id' => $row['news_id'], 'news_body' => $row['news_body'], 'news_header' => $row['news_header'], 'upload_time' => $row['upload_time'], 'upload_date' => $row['upload_date'], 'news_img_1' => $row['news_img_1'], 'admin_id' => $row['admin_id'], 'category_id' => $row['category_id']);

            array_push($adminNewsInfo, $news);
        }
    }
    return $adminNewsInfo;
}

function getSingleCategory($conn, $category_id)
{
    $sql = "SELECT category_name
            FROM   category
            WHERE  category_id='$category_id'";

    $res = mysqli_query($conn, $sql);

    if ($res->num_rows > 0) {

        while ($row = mysqli_fetch_assoc($res)) {
            $category =  array('category_name' => $row['category_name']);
        }
    }

    return $category;
}

function getLikeFavCount($conn, $news_id)
{

    $sql = "SELECT np_id,like_field,fav_field
            FROM   news_preference
            WHERE  news_id='$news_id'";

    $res = mysqli_query($conn, $sql);

    $likeCount = 0;
    $favCount = 0;
    if ($res->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($res)) {

            // echo $row["np_id"] . " " . $row["like_field"] . " " . $row["fav_field"] . "<br>";

            if ($row["like_field"] == '1') {

                $likeCount++;
            }

            if ($row["fav_field"] == '1') {
                $favCount++;
            }

            echo "<br>";
        }
    }

    $likeFavCount = array('like_count' =>  $likeCount, 'fav_count' => $favCount);

    return $likeFavCount;
}

function addCategory($conn, $category_name, $upload_date, $admin_id)
{

    $sql = "INSERT INTO category (category_name,upload_date,admin_id)
    VALUES ('$category_name', '$upload_date', '$admin_id')";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo "<script>
        alert('Category uploaded successfully');
        window.location.href='/online_news_portal/admin/admin_dashboard.php';
        </script>";
    } else {

        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
