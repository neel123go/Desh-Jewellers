<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php
error_reporting(0);
    $cat = new Category();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$maincatName = $_POST['maincatName'];
		$subcatName = $_POST['subcatName'];
		$addsubcat = $cat->subcatinsert($maincatName, $subcatName);
	}
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock">

        <?php
            if (isset($addsubcat)) {
                echo $addsubcat;
            }
        ?>

                 <form action="addsubcat.php" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <input type="radio" name="maincatName" value="Gold">Gold
                                <input type="radio" name="maincatName" value="Gold Plate">Gold Plate
                                <input type="radio" name="maincatName" value="Diamond">Diamond
                            </td>
                        </tr>				
                        <tr>
                            <td>
                                <input type="text" name="subcatName" autocomplete="off" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    
<?php include 'inc/footer.php'; ?>