<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php
    $cat = new Category();

	if (isset($_GET['delid'])) {
		$delid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delid']);
		$delcal = $cat->deletecat($delid);
	}
?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
				<?php
			if (isset($delcal)) {
				echo $delcal;
			}
		?>
                <div class="block">
					
		

                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

		<?php
			$getcat = $cat->getAllcat();
			if ($getcat) {
				$i = 0;
				while ($result = $getcat->fetch_assoc()) {
					$i++;
		?>

						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName']; ?></td>
							<td><a href="editcat.php?catid=<?php echo $result['catId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this category ?')" href="?delid=<?php echo $result['catId']; ?>">Delete</a></td>
						</tr>
		
		<?php }	} ?>

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