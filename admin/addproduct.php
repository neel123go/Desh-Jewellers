<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php include '../classes/Product.php'; ?>
<?php
    $pd = new Product();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$insertpd = $pd->productinsert($_POST, $_FILES);
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add a Product</h2>
                <div class="block">
                    
        <?php
            if (isset($insertpd)) {
                echo $insertpd;
            }
        ?>

                 <form action="addproduct.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Product Name</label>
                            </td>
                            <td>
                                <input type="text" name="productName" autocomplete="off" placeholder="Enter Post Title..." class="medium" />
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
                                    
                                    <option value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></option>

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
                                    
                                    <option value="<?php echo $result['catId']; ?>"><?php echo $result['subcatName']; ?> (<?php echo $result['maincatName']; ?>)</option>

            <?php } } ?>

                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Description</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body" cols="70" rows="8"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Product Price</label>
                            </td>
                            <td>
                                <input type="text" name="price" autocomplete="off" placeholder="Product Price" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Product Rating</label>
                            </td>
                            <td>
                                <input type="reange" name="rating" autocomplete="off" placeholder="5.0" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Product Type</label>
                            </td>
                            <td>
                                <select name="type" id="select">
                                    <option>Select Type</option>
                                    <option value="0">New</option>
                                    <option value="1">Best Sale</option>
                                    <option value="2">Flash Deals</option>
                                    <option value="3">General</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="date" name="date" />
                            </td>
                        </tr>



						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Upload" />
                            </td>
                        </tr>
                    </table>
                   </form>
                </div>
            </div>
        </div>

<?php include 'inc/footer.php'; ?>