<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php
    $cat = new Category();

	if (isset($_GET['delid'])) {
        $delid = $_GET['delid'];
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
							<th>Main Category Name</th>
							<th>Sub Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

		<?php
			$getcat = $cat->getAllsubcat();
			if ($getcat) {
				$i = 0;
				while ($result = $getcat->fetch_assoc()) {
					$i++;
		?>

						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['maincatName']; ?></td>
							<td><?php echo $result['subcatName']; ?></td>
							<td><a href="editsubcat.php?catid=<?php echo $result['catId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this sub category ?')" href="?delid=<?php echo $result['catId']; ?>">Delete</a></td>
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