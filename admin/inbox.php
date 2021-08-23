<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>

<?php
	if (isset($_GET['seenid'])) {
		$seenid = $_GET['seenid'];
		$query = "UPDATE tbl_msg
                    SET
                    status = '1'
                    WHERE id = '$seenid'
                ";
		$seen_msg = $db->update($query);
		if ($seen_msg) {
			echo "<span class='success'>Message seen.</span>";
		} else {
			echo "<span class='error'>Something is worng! Message dosn't seen.</span>";
		}
	} elseif (isset($_GET['unseenid'])){
		$unseenid = $_GET['unseenid'];
		$query = "UPDATE tbl_msg
                    SET
                    status = '0'
                    WHERE id = '$unseenid'
                ";
		$unseen_msg = $db->update($query);
		if ($unseen_msg) {
			echo "<span class='success'>Message unseen.</span>";
		} else {
			echo "<span class='error'>Something is worng! Message dosn't unseen.</span>";
		}
	}
?>

                <div class="block">
						<table class="data display datatable" id="example">
						<thead>
							<tr>
								<th width="5%">No.</th>
								<th width="20%">Full Name</th>
								<th width="18%">Email</th>
								<th width="23%">Message</th>
								<th width="19%">Date</th>
								<th width="14%">Action</th>
							</tr>
						</thead>
						<tbody>

					<?php
						$query = "SELECT * FROM tbl_msg WHERE status='0' ORDER BY id DESC";
						$msg = $db->select($query);
						if ($msg) {
							$i = 0;
							while ($result = $msg->fetch_assoc()) {
								$i++;
					?>

							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['firstname'] . " " . $result['lastname']; ?></td>
								<td><?php echo $result['email']; ?></td>
								<td><?php echo $fm->textsort($result['message'], 30); ?></td>
								<td><?php echo $fm->formatdate($result['date']); ?></td>
								<td>
									<a href="view.php?msgid=<?php echo $result['id']; ?>">View</a> || 
									<a href="reply.php?msgid=<?php echo $result['id']; ?>">Reply</a> ||
									<a href="?seenid=<?php echo $result['id']; ?>">Seen</a>
								</td>
							</tr>

					<?php } } ?>
							
						</tbody>
					</table>      
               </div>
            </div>


			<div class="box round first grid">
				<?php error_reporting(0) ?>
                <h2>Seen Message</h2>

<?php
	if (isset($_GET['delid'])) {
		$delid = $_GET['delid'];
		$query = "DELETE FROM tbl_msg WHERE id='$delid'";
		$delete = $db->delete($query);
		if ($delete) {
			echo "<span class='success'>Message deleted successfully.</span>";
		} else {
			echo "<span class='error'>Something is worng, Message dosn't deleted !</span>";
		}
	}
?>

                <div class="block">        
					<table class="data display datatable" id="example">
						<thead>
							<tr>
								<th width="5%">No.</th>
								<th width="18%">Full Name</th>
								<th width="17%">Email</th>
								<th width="23%">Message</th>
								<th width="17%">Date</th>
								<th width="16%">Action</th>
							</tr>
						</thead>
						<tbody>

					<?php
						$query = "SELECT * FROM tbl_msg WHERE status='1' ORDER BY id DESC";
						$msg = $db->select($query);
						if ($msg) {
							$i = 0;
							while ($result = $msg->fetch_assoc()) {
								$i++;
					?>

							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['firstname'] . " " . $result['lastname']; ?></td>
								<td><?php echo $result['email']; ?></td>
								<td><?php echo $fm->textsort($result['message'], 30); ?></td>
								<td><?php echo $fm->formatdate($result['date']); ?></td>
								<td>
									<a href="view.php?msgid=<?php echo $result['id']; ?>">View</a> ||
									<a onclick="return confirm('Are you to delete this message ?')" href="?delid=<?php echo $result['id']; ?>">Delete</a> ||
									<a href="?unseenid=<?php echo $result['id']; ?>">Unseen</a>
								</td>
							</tr>

					<?php } } ?>
							
						</tbody>
					</table>
               </div>
            </div>










        </div>

<?php include 'inc/footer.php'; ?>