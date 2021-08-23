<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    if (!isset($_GET['postid']) || $_GET['postid'] == NULL) {
        header("Location:postlist.php");
    } else {
        $viewpostid = $_GET['postid'];
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Post</h2>
                <div class="block">

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<script>window.location = 'postlist.php';</script>";
            }
        ?>
                 <form action="" method="post">
                    <table class="form">
        
        <?php
            $query = "SELECT * FROM tbl_post WHERE id='$viewpostid'";
            $post = $db->select($query);
            if ($post) {
                while ($uppost = $post->fetch_assoc()) {
        ?>

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" readonly name="tittle" autocomplete="off" value="<?php echo $uppost['tittle']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" readonly name="cat">
                                    <option>Select Category</option>
                                    
                    <?php
                        $query = "SELECT * FROM tbl_category";
                        $category = $db->select($query);
                        if ($category) {
                            while ($result = $category->fetch_assoc()) {
                    ?>

                                    <option
                                    
                    <?php if ($uppost['cat'] == $result['id']) { ?>
                        selected="seleted"
                    <?php } ?>

                                    value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>

                    <?php } } ?>

                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $uppost['image']; ?>" height="120px" width="120px"></br>
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" readonly name="body">
                                    <?php echo $uppost['body']; ?>
                                </textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" readonly autocomplete="off" value="<?php echo $uppost['author']; ?>" class="medium" />
                                <input type="hidden" name="userid" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" readonly autocomplete="off" value="<?php echo $uppost['tags']; ?>" class="medium" />
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