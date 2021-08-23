<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $text = mysqli_real_escape_string($db->link, $_POST['text']);

        if ($text == "") {
            echo "<span class='error'>Fild must not be empty !</span>";
        } else {
            $query = "UPDATE tbl_copyright
                    SET
                    text = '$text'
                    WHERE id = '1'
                ";
            $update_copy = $db->update($query);
            if ($update_copy) {
                echo "<span class='success'>Copyright text updated successfully.</span>";
            } else {
                echo "<span class='error'>Something is worng! Copyright text dosn't updated.</span>";
            }
        }
    }
?>

                <div class="block copyblock">

<?php
    $query = "SELECT * FROM tbl_copyright WHERE id='1'";
    $copyright = $db->select($query);
    if ($copyright) {
        while ($result = $copyright->fetch_assoc()) {
?>

                 <form action="copyright.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" autocomplete="off" value="<?php echo $result['text']; ?>" name="text" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
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