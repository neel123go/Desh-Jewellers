<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    if (Session::get("userrole") == 'Admin' || Session::get("userrole") == 'Moderator' ||Session::get("userrole") == 'Post Editor') {
        echo '';
    } else {
        echo "<script>window.location = 'catlist.php';</script>";
    }
?>
<?php
    if (!isset($_GET['editid']) || $_GET['editid'] == NULL) {
        header("Location:catlist.php");
    } else {
        $upcatid = $_GET['editid'];
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 

            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $_POST['name'];
                    $name = mysqli_real_escape_string($db->link, $name);

                    if (empty($name)) {
                        echo "<span class='error'>Fild must not be empty !</span>";
                    } else {
                        $query = "UPDATE tbl_category
                            SET
                            name = '$name'
                            WHERE id = '$upcatid'
                        ";
                        $updat_cat = $db->update($query);
                        if ($updat_cat) {
                            echo "<span class='success'>Category updated successfully.</span>";
                        } else {
                            echo "<span class='error'>Something is worng, Category dosn't updated !</span>";
                        }
                    }
                }
            ?>
            <?php
                $query = "SELECT * FROM tbl_category WHERE id='$upcatid' ORDER BY id DESC";
                $category = $db->select($query);
                if ($category) {
                while ($result = $category->fetch_assoc()) {
            ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" autocomplete="off" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
            <?php } } ?>
                </div>
            </div>
        </div>

<?php include 'inc/footer.php'; ?>