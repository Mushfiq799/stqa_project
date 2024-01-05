<?php
session_start();
if (!isset($_SESSION["user_id"]) ||  $_SESSION["user_role"] != "admin") {
    header('location:/online_news_portal/main.php');
    exit();
}

include_once "./admin_header.php";
include_once "../includes/dbh.inc.php";
include_once "../includes/functions.inc.php";

$readersInfo = getAllReaderInfo($conn);


?>
<main style="height:1700px">
    <div class="container mt-3">
        <h4>All Users</h4>
        <table class="table">

            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Address</th>


                </tr>
            </thead>
            <tbody>

                <?php foreach ($readersInfo as $reader) { ?>
                    <tr>
                        <td scope="col"><?php echo $reader["reader_id"] ?></td>
                        <td scope="col"><?php echo $reader["reader_firstname"] ?></td>
                        <td scope="col"><?php echo $reader["reader_lastname"] ?></td>
                        <td scope="col"><?php echo $reader["reader_email"] ?></td>
                        <td scope="col"><?php echo $reader["reader_contact_number"] ?></td>
                        <td scope="col"><?php echo $reader["reader_address"] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="/online_news_portal/admin/admin_viewers.php" class="btn btn-info">See Users Interacted</a>
    </div>





</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>