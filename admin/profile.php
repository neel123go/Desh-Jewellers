<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    $userid = Session::get("userid");
    $userrole = Session::get("userrole");
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Post</h2>
                <div class="block">

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = mysqli_real_escape_string($db->link, $_POST['username']);
                $email = mysqli_real_escape_string($db->link, $_POST['email']);
                $details = mysqli_real_escape_string($db->link, $_POST['details']);

                if ($username == "" || $email == "" || $details == ""){
                    echo "<span class='error'>Filed must not be empty.</span>"; 
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<span class='error'>This e-mail address is not valited.</span>"; 
                } else {
                    $query = "UPDATE tbl_user SET
                            username = '$username',
                            email = '$email',
                            details = '$details'
                            WHERE id = '$userid'
                        ";
                        $updated_rows = $db->update($query);
                        if ($updated_rows) {
                            echo "<span class='success'>Your data updated successfully.</span>";
                        } else {
                            echo "<span class='error'>Something is worng! Your data doesn't updated.</span>";
                        }
                    }
                }
        ?>
                 <form action="" method="post">
                    <table class="form">
        
        <?php
            $query = "SELECT * FROM tbl_user WHERE id='$userid' AND role='$userrole'";
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
                                <input type="text" name="username" autocomplete="off" value="<?php echo $result['username']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" autocomplete="off" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details">
                                    <?php echo $result['details']; ?>
                                </textarea>
                            </td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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