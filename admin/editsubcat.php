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
		$maincatName = $_POST['maincatName'];
		$subcatName = $_POST['subcatName'];
		$updatesubcat = $cat->subcatupdate($maincatName, $subcatName, $id);
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

                 <form action="editsubcat.php" method="post">
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
                                <input type="radio" name="maincatName" value="Diamond"
                                
        <?php
            if ($result["maincatName"] == 'Diamond') {
                echo "checked";
            }
        ?>
                                
                                >Diamond
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