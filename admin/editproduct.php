<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php include '../classes/Product.php'; ?>
<?php
    if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
        echo "<script>window.location = 'productlist.php'; </script>";
    } else {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
    }
    $pd = new Product();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$updatepd = $pd->productupdate($_POST, $_FILES, $id);
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add a Product</h2>
                <div class="block">
                    
        <?php
            if (isset($updatepd)) {
                echo $updatepd;
            }

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
                                <input type="text" name="productName" autocomplete="off" value="<?php echo $value['productName']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Main Category</label>
                            </td>
                            <td>
                                <select id="select" name="catId">
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
                                <select id="select" name="subcatId">
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
                                <input type="file" name="image" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Description</label>
                            </td>
                            <td>
                                <textarea name="body" cols="70" rows="8"><?php echo $value['body']; ?></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Product Price</label>
                            </td>
                            <td>
                                <input type="text" name="price" autocomplete="off" value="<?php echo $value['price']; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Product Rating</label>
                            </td>
                            <td>
                                <input type="reange" name="rating" autocomplete="off" value="<?php echo $value['rating']; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Product Type</label>
                            </td>
                            <td>
                                <select name="type" id="select">
                                    <option>Select Type</option>

                        <?php if ($value['type'] == 0) { ?>
                                <option selected="selected" value="0">Featured</option>
                                <option value="1">General</option>
                        <?php } else { ?>
                                <option selected="selected" value="1">General</option>
                                <option value="0">Featured</option>
                        <?php } ?>

                                    
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="date" name="date" value="<?php echo $value['date']; ?>" />
                            </td>
                        </tr>



						<tr>
                            <td></td>
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