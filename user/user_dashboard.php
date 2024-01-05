<?php

session_start();
if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == "reader") {


    include_once "./user_header.php";
    include_once '../includes/dbh.inc.php';
    include_once '../includes/functions.inc.php';
    $readerInfo = getReaderInfo($conn, $_SESSION['user_id']);


?>
    <main style="height:1000px">


        <ul class="list-group container">
            <h3 class="mt-2"> Welcome <?php echo $readerInfo["reader_firstname"] . " " . $readerInfo["reader_lastname"] ?></h3>
            <li class="list-group-item"> <span>ID : </span> <?php echo $readerInfo["reader_id"] ?></li>
            <li class="list-group-item"> <span>Email : </span> <?php echo $readerInfo["reader_email"] ?></li>
            <li class="list-group-item"> <span>Password : </span><?php echo $readerInfo["reader_pass"] ?></li>
            <li class="list-group-item"> <span>Contact Number :</span><?php echo $readerInfo["reader_contact_number"] ?></li>
            <li class="list-group-item"> <span>Address :</span><?php echo $readerInfo["reader_address"] ?></li>

            <br>
            <br>
            <h3>Edit Your User Information</h3>

            <form action="/online_news_portal/includes/user_inc/user_edit_inc.php" method="POST">
                <input type="text" hidden name="user_id" value="<?php echo  $readerInfo["reader_id"]; ?>">
                <input type="text" name="user_firstname" placeholder="First name" value="<?php echo $readerInfo["reader_firstname"] ?>"> <br>
                <input type="text" name="user_lastname" placeholder="Last name" value="<?php echo $readerInfo["reader_lastname"] ?>"> <br>
                <input type="text" name="user_email" placeholder="Email" value="<?php echo $readerInfo["reader_email"] ?>"> <br>
                <input type="password" name="user_password" placeholder="Password" value="<?php echo $readerInfo["reader_pass"] ?>"> <br>
                <input type="password" name="user_password_repeat" placeholder="Password" value="<?php echo $readerInfo["reader_pass"] ?>"> <br>
                <input type="text" name="user_contact_number" placeholder="Contact Number" value="<?php echo $readerInfo["reader_contact_number"] ?>"> <br>
                <input type="text" name="user_address" placeholder="Address" value="<?php echo $readerInfo["reader_address"] ?>"> <br>
                <br>
                <button type="submit" class="btn btn-info" name="edit_reader">Edit Info</button>
                <br>

            </form>


        </ul>


    </main>

<?php } else {
    header('location:/online_news_portal/login.php');
} ?>