<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    $userid = Session::get("userid");
    $userrole = Session::get("userrole");
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Change Password</h2>
               <div class="block copyblock"> 

            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $oldpass = $_POST['oldpass'];
                    $oldpass = mysqli_real_escape_string($db->link, md5($oldpass));

                    $newpass = $_POST['newpass'];
                    $newpass = mysqli_real_escape_string($db->link, md5($newpass));

                    $query = "SELECT * FROM tbl_user WHERE id='$userid' AND role='$userrole'";
                    $user = $db->select($query);
                    if ($user) {
                        while ($result = $user->fetch_assoc()) {
                            $realpass = $result['password'];
                     } }

                    if (empty($oldpass) || empty($newpass)) {
                        echo "<span class='error'>Fild must not be empty !</span>";
                    } elseif ($realpass != $oldpass) {
                        echo "<span class='error'>Your old password doesn't match!<span>";
                    }
                    else {
                        $query = "UPDATE tbl_user SET
                        password = '$newpass'
                        WHERE id = '$userid'
                        ";
                        $updated_rows = $db->update($query);
                        if ($updated_rows) {
                            echo "<span class='success'>Your password updated successfully.</span>";
                        } else {
                            echo "<span class='error'>Something is worng! Your password doesn't updated.</span>";
                        }
                    }
                }
            ?>

                 <form action="changepassword.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <h5>Old Password</h5>
                            </td>
                            <td>
                                <input type="password" name="oldpass" autocomplete="off" placeholder="Enter new password"/>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5>New Password</h5>
                            </td>
                            <td>
                                <input type="password" name="newpass" autocomplete="off" placeholder="Enter old password"/>
                            </td>
                        </tr>

						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Change" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>

<?php include 'inc/footer.php'; ?>