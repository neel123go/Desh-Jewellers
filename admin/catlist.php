<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>

			<?php
				if (isset($_GET['deleditid'])) {
					$delid = $_GET['deleditid'];
					$query = "DELETE FROM tbl_category WHERE id='$delid'";
					$delete = $db->delete($query);
					if ($delete) {
						echo "<span class='success'>Category deleted successfully.</span>";
					} else {
						echo "<span class='error'>Something is worng, Category dosn't deleted !</span>";
					}
				}
			?>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>

			<?php
				if (Session::get("userrole") == 'Admin' || Session::get("userrole") == 'Moderator'|| Session::get("userrole") == 'Post Editor') { ?>
							<th>Action</th>
			<?php } ?>
	
							
						</tr>
					</thead>
					<tbody>

				<?php
					$query = "SELECT * FROM tbl_category ORDER BY id DESC";
					$category = $db->select($query);
					if ($category) {
						$i = 0;
						while ($result = $category->fetch_assoc()) {
							$i++;
				?>

						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']; ?></td>

			<?php
				if (Session::get("userrole") == 'Admin' || Session::get("userrole") == 'Moderator') { ?>

			<td><a onclick="return confirm('Are you to delete this post ?')" href="?deleditid=<?php echo $result['id']; ?>">Delete</a></td>

			<?php } elseif (Session::get("userrole") == 'Post Editor') { ?>
					|| <td><a href="edit.php?editid=<?php echo $result['id']; ?>">Edit</a></td>
			<?php } ?>

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