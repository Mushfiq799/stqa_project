<?php



session_start();
include_once "./admin_header.php";
if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == "admin") {



    include_once '../includes/dbh.inc.php';
    include_once '../includes/functions.inc.php';
    $categoryInfo = getAllCategory($conn);


?>
    <main style="height:1000px">


        <table class="table container">

            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Cateogry Name</th>
                    <th scope="col">Upload Date</th>
                    <th scope="col">Admin Id </th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($categoryInfo as $category) {

                ?>
                    <tr>
                        <td scope="col"><?php echo  $category["category_id"] ?></td>
                        <td scope="col"><?php echo $category["category_name"] ?></td>
                        <td scope="col"><?php echo  $category["upload_date"] ?></td>
                        <td scope="col"><?php echo  $category["admin_id"] ?></td>


                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="container">
            <form action="/online_news_portal/includes/admin_inc/admin_category_inc.php" method="POST">
                <label class="mt-3">New Category Name: </label>
                <input type="text" name="category_name">
                <input type="text" hidden name="admin_id" value="<?php echo $_SESSION['user_id'] ?>">

                <button type="submit" class="btn btn-info" name="add_category">Add Cateogry</button>
                <br>

            </form>
        </div>


    </main>

<?php } ?>