<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <div class="block">

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $youtube = $_POST['youtube'];
                $facebook = $_POST['facebook'];
                $twitter = $_POST['twitter'];
                $github = $_POST['github'];
                $linkedin = $_POST['linkedin'];

                $youtube = mysqli_real_escape_string($db->link, $youtube);
                $facebook = mysqli_real_escape_string($db->link, $facebook);
                $twitter = mysqli_real_escape_string($db->link, $twitter);
                $github = mysqli_real_escape_string($db->link, $github);
                $linkedin = mysqli_real_escape_string($db->link, $linkedin);

                if ($youtube == "" || $facebook == "" || $twitter == "" || $github == "" || $linkedin == "") {
                    echo "<span class='error'>Fild must not be empty !</span>";
                } else {
                    $query = "UPDATE social_link
                            SET
                            youtube = '$youtube',
                            facebook = '$facebook',
                            twitter = '$twitter',
                            github = '$github',
                            linkedin = '$linkedin'
                            WHERE id = '1'
                        ";
                    $updat_link = $db->update($query);
                    if ($updat_link) {
                        echo "<span class='success'>Link updated successfully.</span>";
                    } else {
                        echo "<span class='error'>Something is worng! Link dosn't updated.</span>";
                    }
                }
            }
        ?>
                    
        <?php
            $query = "SELECT * FROM social_link WHERE id='1'";
            $link = $db->select($query);
            if ($link) {
                while ($result = $link->fetch_assoc()) {
        ?>

                 <form action="social.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Youtube</label>
                            </td>
                            <td>
                                <input type="text" name="youtube" autocomplete="off" value="<?php echo $result['youtube']; ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="facebook"  autocomplete="off" value="<?php echo $result['facebook']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twitter" autocomplete="off" value="<?php echo $result['twitter']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Github</label>
                            </td>
                            <td>
                                <input type="text" name="github" autocomplete="off" value="<?php echo $result['github']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="linkedin" autocomplete="off" value="<?php echo $result['linkedin']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>

        <?php } } ?>

                </div>
            </div>
        </div>

<?php include 'inc/footer.php'; ?>