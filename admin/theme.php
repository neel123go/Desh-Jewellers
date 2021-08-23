<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Themes</h2>
               <div class="block copyblock"> 

            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $theme = mysqli_real_escape_string($db->link, $_POST['theme']);

                    $query = "UPDATE tbl_theme
                        SET
                        theme = '$theme'
                        WHERE id = '1'
                    ";
                    $update_theme = $db->update($query);
                    if ($update_theme) {
                        echo "<span class='success'>Theme updated successfully.</span>";
                    } else {
                        echo "<span class='error'>Something is worng, Theme dosn't updated !</span>";
                    }
                }
            ?>
            <?php
                $query = "SELECT * FROM tbl_theme WHERE id='1'";
                $category = $db->select($query);
                while ($result = $category->fetch_assoc()) {
            ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input <?php if ($result['theme'] == 'light') { echo "checked"; }?> type="radio" name="theme" value="light"/> Light Mode
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input <?php if ($result['theme'] == 'dark') { echo "checked"; }?> type="radio" name="theme" value="dark"/> Dark Mode
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Change" />
                            </td>
                        </tr>
                    </table>
                    </form>
            <?php } ?>
                </div>
            </div>
        </div>

<?php include 'inc/footer.php'; ?>