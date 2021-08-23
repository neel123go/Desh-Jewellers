<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    if (!isset($_GET['userid']) || $_GET['userid'] == NULL) {
        echo "<script>window.location = 'userlist.php';</script>";
    } else {
        $viewid = $_GET['userid'];
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Post</h2>
                <div class="block">

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<script>window.location = 'userlist.php';</script>";
            }
        ?>
                 <form action="viewuser.php" method="post">
                    <table class="form">
        
        <?php
            $query = "SELECT * FROM tbl_user WHERE id='$viewid'";
            $user = $db->select($query);
            if ($user) {
                while ($result = $user->fetch_assoc()) {
        ?>
                        
                        <tr>
                            <td>
                                <label>User Role</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['role']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly name="username" value="<?php echo $result['username']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" readonly name="email" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" readonly name="details">
                                    <?php echo $result['details']; ?>
                                </textarea>
                            </td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Back" />
                            </td>
                        </tr>
            
            <?php } } ?>

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