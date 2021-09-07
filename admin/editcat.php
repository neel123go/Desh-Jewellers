<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script>window.location = 'catlist.php'; </script>";
    } else {
        $id = $_GET['catid'];
    }
    $cat = new Category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$catName = $_POST['catName'];
		$updatecat = $cat->catUpdate($catName, $id);
	}
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock">

        <?php
            if (isset($updatecat)) {
                echo $updatecat;
            }
        ?>

        <?php
            $getCatbyId = $cat->getCatbyId($id);
            if ($getCatbyId) {
                while ($result = $getCatbyId->fetch_assoc()) {
        ?>

                 <form action="" method="post">
                    <table class="form">			
                        <tr>
                            <td>
                                <input type="text" name="catName" autocomplete="off" value="<?php echo $result['catName']; ?>" class="medium" />
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