<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    if (Session::get("userrole") == 'Admin' || Session::get("userrole") == 'Moderator') {
        echo '';
    } else {
        echo "<script>window.location = 'catlist.php';</script>";
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
                        $query = "INSERT INTO tbl_category(name) VALUES('$name')";
                        $catname = $db->insert($query);
                        if ($catname) {
                            echo "<span class='success'>Category inserted successfully.</span>";
                        } else {
                            echo "<span class='error'>Something is wornk, Category dosn't inserted !</span>";
                        }
                    }
                }
            ?>

                 <form action="addcat.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" autocomplete="off" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>

<?php include 'inc/footer.php'; ?>