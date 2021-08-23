<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>All User List</h2>

        <?php
            if (isset($_GET['delid'])) {
                $delid = $_GET['delid'];
                $query = "DELETE FROM tbl_user WHERE id='$delid'";
                $delete = $db->delete($query);
                if ($delete) {
                    echo "<span class='success'>User deleted successfully.</span>";
                } else {
                    echo "<span class='error'>Something is worng, User dosn't deleted !</span>";
                }
            }
        ?>

                <div class="block">
                 <form action="" method="post">
                    <table class="data display datatable" id="example">
                        <thead>
                            <tr>
                                <th width="10%">No.</th>
                                <th width="38%">User Name</th>
                                <th width="38%">User Role</th>
                                <th width="14%">Action</th>
                            </tr>
                        </thead>
					<tbody>
        
        <?php
            $query = "SELECT * FROM tbl_user ORDER BY position ASC";
            $userlist = $db->select($query);
            if ($userlist) {
                $i=0;
                while ($result = $userlist->fetch_assoc()) {
                    $i++;
        ?>
                        
                        <tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['username']; ?></td>
							<td><?php echo $result['role']; ?></td>


							<td><a href="viewuser.php?userid=<?php echo $result['id']; ?>">View</a> 
                            
            <?php
                if (Session::get("userrole") == 'Admin') { ?>
                            || <a onclick="return confirm('Are you to delete this User ?')" href="?delid=<?php echo $result['id']; ?>">Delete</a></td>
            <?php } ?>
            
                        </tr>

            <?php } } ?>

                        </tbody>
                      </table>
                    </form>
                </div>
            </div>
        </div>

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>

<?php include 'inc/footer.php'; ?>