<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script>window.location = 'subcatlist.php'; </script>";
    } else {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catid']);
    }
?>
<?php
    $cat = new Category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$maincatName = $_POST['maincatName'];
        $subcatName = $_POST['subcatName'];
		$updatesubcat = $cat->SubcatUpdate($id, $maincatName, $subcatName);
	}
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Sub Category</h2>
               <div class="block copyblock">

        <?php
            if (isset($updatesubcat)) {
                echo $updatesubcat;
            }
        ?>

        <?php
            $getCatbyId = $cat->getSubcatByid($id);
            if ($getCatbyId) {
                while ($result = $getCatbyId->fetch_assoc()) {
        ?>

                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <input type="radio" name="maincatName" value="Gold"
                                
        <?php
            if ($result["maincatName"] == 'Gold') {
                echo "checked";
            }
        ?>
                                
                                >Gold
                                <input type="radio" name="maincatName" value="GoldPlate"
                                
        <?php
            if ($result["maincatName"] == 'GoldPlate') {
                echo "checked";
            }
        ?>

                                >Gold Plate
                            </td>
                        </tr>				
                        <tr>
                            <td>
                                <input type="text" name="subcatName" autocomplete="off" value="<?php echo $result['subcatName']; ?>" class="medium" />
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