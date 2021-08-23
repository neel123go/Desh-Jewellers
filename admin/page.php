<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
        echo "<script>window.location = 'index.php';</script>";
    } else {
        $pageid = $_GET['pageid'];
    }
?>

<style>
    .delete{
        border: 1px solid #ddd;
        color: #444;
        cursor: pointer;
        font-size: -12px;
        padding: 3px 20px;
        font: 400 19.3333px Arial;
        background: #efefef;
    }
</style>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Post</h2>

        <?php
            if (isset($_GET['delid'])) {
                $delid = $_GET['delid'];
                $query = "DELETE FROM tbl_page WHERE id='$delid'";
                $delete = $db->delete($query);
                if ($delete) {
                    echo "<span class='success'>Category deleted successfully.</span>";
                } else {
                    echo "<span class='error'>Something is worng, Category dosn't deleted !</span>";
                }
            }
		?>

                <div class="block">

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = mysqli_real_escape_string($db->link, $_POST['name']);
                $body = mysqli_real_escape_string($db->link, $_POST['body']);

                if ($name == "" || $body == ""){
                    echo "<span class='error'>Filed must not be empty !!</span>"; 
                } else {
                        $query = "UPDATE tbl_page SET
                            name = '$name',
                            body = '$body'
                            WHERE id = '$pageid'
                        ";
                        $update_row = $db->update($query);
                        if ($update_row) {
                            echo "<span class='success'>Post updateded successfully.</span>";
                        } else {
                            echo "<span class='error'>Something is worng! Post doesn't updateded.</span>";
                        }
                    }
                }
        ?>
                 <form action="" method="post">
                    <table class="form">
        
        <?php
            $query = "SELECT * FROM tbl_page WHERE id='$pageid'";
            $page = $db->select($query);
            if ($page) {
                while ($result = $page->fetch_assoc()) {
        ?>

                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" autocomplete="off" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $result['body']; ?>
                                </textarea>
                            </td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                                <a onclick="return confirm('Are you to delete this page ?')" class="delete" href="?delid=<?php echo $result['id']; ?>">Delete</a>
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