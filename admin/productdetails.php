<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/Product.php');
    include_once ($filepath.'/../classes/Category.php');
?>
<?php
    if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
        echo "<script>window.location = 'inbox.php'; </script>";
    } else {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		echo "<script>window.location = 'inbox.php'; </script>";
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add a Product</h2>
                <div class="block">
                    
        <?php
            $pd = new Product();
            $getproduct = $pd->getproductbyid($id);
            if ($getproduct) {
                while ($value = $getproduct->fetch_assoc()) {
        ?>

                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Product Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $value['productName']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Main Category</label>
                            </td>
                            <td>
                                <select id="select" readonly>
                                <option>Select Category</option>

            <?php
                $cat = new Category();
                $getcat = $cat->getAllcat();
                if ($getcat) {
                    while ($result = $getcat->fetch_assoc()) {
            ?>
                                    
                                    <option 

                        <?php
                            if ($value['catId'] == $result['catId']) {
                                echo "selected";
                            }
                        ?>

                                    value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></option>

            <?php } } ?>

                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Sub Category</label>
                            </td>
                            <td>
                                <select id="select" >
                                    <option>Select Sub Category</option>

            <?php
                $getsubcat = $cat->getAllsubcat();
                if ($getsubcat) {
                    while ($result = $getsubcat->fetch_assoc()) {
            ?>
                                    
                                    <option 
                                    
                        <?php
                            if ($value['catId'] == $result['catId']) {
                                echo "selected";
                            }
                        ?>

                                    value="<?php echo $result['catId']; ?>"><?php echo $result['subcatName']; ?> (<?php echo $result['maincatName']; ?>)</option>

            <?php } } ?>

                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $value['image']; ?>" width="200px" height="200px"><br>
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Description</label>
                            </td>
                            <td>
                                <textarea readonly cols="70" rows="8"><?php echo $value['body']; ?></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Product Price</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $value['price']; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Product Rating</label>
                            </td>
                            <td>
                                <input type="reange" readonly value="<?php echo $value['rating']; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Product Type</label>
                            </td>
                            <td>
                                <select  id="select">
                                    <option>Select Type</option>

                        <?php if ($value['type'] == 0) { ?>
                                <option selected="selected" value="0">New</option>
                                <option value="1">Best Sale</option>
                                <option value="2">Flash Deals</option>
                                <option value="3">General</option>
                        <?php } elseif ($value['type'] == 1) { ?>
                                <option value="0">New</option>
                                <option selected="selected" value="1">Best Sale</option>
                                <option value="2">Flash Deals</option>
                                <option value="3">General</option>
                        <?php } elseif ($value['type'] == 2) { ?>
                                <option value="0">New</option>
                                <option value="1">Best Sale</option>
                                <option selected="selected" value="2">Flash Deals</option>
                                <option value="3">General</option>
                        <?php } else { ?>
                                <option value="0">New</option>
                                <option value="1">Best Sale</option>
                                <option value="2">Flash Deals</option>
                                <option selected="selected" value="3">General</option>
                        <?php } ?>

                                    
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="date" readonly value="<?php echo $value['date']; ?>" />
                            </td>
                        </tr>



						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Back" />
                            </td>
                        </tr>
                    </table>
                   </form>

            <?php } } ?>

                </div>
            </div>
        </div>

<?php include 'inc/footer.php'; ?>