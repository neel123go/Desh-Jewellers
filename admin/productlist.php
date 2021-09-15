<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Product.php'; ?>
<?php include_once '../helper/Format.php'; ?>
<?php
	$pd = new Product();
	$fm = new Format();

	if (isset($_GET['delid'])) {
		$delid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delid']);
		$delpro = $pd->deletepro($delid);
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>

			<?php
				if (isset($delpro)) {
					echo $delpro;
				}
			?>

                <div class="block">
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>NO</th>
							<th>Product Name</th>
							<th>Catid</th>
							<th>Subcatid</th>
							<th>Image</th>
							<th>Description</th>
							<th>Rating</th>
							<th>Price</th>
							<th>Type</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

			<?php
				$getproduct = $pd->getallproduct();
				if ($getproduct) {
					$i = 0;
					while ($result = $getproduct->fetch_assoc()) {
						$i++;
			?>

						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['catName']; ?></td>
							<td><?php echo $result['subcatName']; ?></td>
							<td><img src="<?php echo $result['image']; ?>" width="50px" height="50px"></td>
							<td><?php echo $fm->textsort($result['body'], 50); ?></td>
							<td><?php echo $result['rating']; ?></td>
							<td>৳ <?php echo $result['price']; ?></td>
							<td>
								<?php
									if ($result['type'] == 0) {
										echo "Featured";
									} else {
										echo "General";
									}
								?>
							</td>
							<td><?php echo $result['date']; ?></td>
							<td><a href="editproduct.php?proid=<?php echo $result['productId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this product ?')" href="?delid=<?php echo $result['productId']; ?>">Delete</a></td>
						</tr>
						
			<?php } } ?>

					</tbody>
				</table>
               </div>
            </div>
        </div>

	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>

<?php include 'inc/footer.php'; ?>