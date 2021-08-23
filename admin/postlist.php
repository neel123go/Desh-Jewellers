<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">

		<?php
			if (isset($_GET['delpostid'])) {
				$delid = $_GET['delpostid'];
				$query = "DELETE FROM tbl_post WHERE id='$delid'";
				$delete = $db->delete($query);
				if ($delete) {
					echo "<span class='success'>Post deleted successfully.</span>";
				} else {
					echo "<span class='error'>Something is worng! post dosn't deleted.</span>";
				}
			}
		?>

                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="4%">No.</th>
							<th width="15%">Title</th>
							<th width="18%">Description</th>
							<th width="9%">Category</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="10%">Date</th>
							<th width="14%">Action</th>
						</tr>
					</thead>
					<tbody>

			<?php
				$query = "SELECT tbl_post.*, tbl_category.name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat = tbl_category.id
				ORDER BY id DESC";
				$post = $db->select($query);
				if ($post) {
					$i = 0;
					while ($result = $post->fetch_assoc()) {
						$i++;
			?>

						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['tittle']; ?></td>
							<td><?php echo $fm->textsort($result['body'], 50); ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><img src="<?php echo $result['image']; ?>" width="60px" height="60px"></td>
							<td><?php echo $result['author']; ?></td>
							<td><?php echo $result['tags']; ?></td>
							<td><?php echo $fm->formatdate($result['date']); ?></td>
							<td>
								<a href="viewpost.php?postid=<?php echo $result['id']; ?>">View</a>

			<?php

				if (Session::get("userid") == $result['userid'] || Session::get("userrole") == "Admin") { ?>
					 || <a href="editpost.php?editpostid=<?php echo $result['id']; ?>">Edit</a> || <a onclick="return confirm('Are you to delete this post ?')" href="?delpostid=<?php echo $result['id']; ?>">Delete</a>

			<?php } ?>

							</td>
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