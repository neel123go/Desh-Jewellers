<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php
    $cat = new Category();
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
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
							<td><a href="editcat?catid=<?php echo $result['catId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this category ?')" href="?delid=<?php echo $result['catId']; ?>">Delete</a></td>
						</tr>
		
		<?php }	} ?>

					</tbody>
				</table>
               </div>
            </div>
        </div>

<?php include 'inc/footer.php'; ?>