<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    if (!isset($_GET['editpostid']) || $_GET['editpostid'] == NULL) {
        header("Location:postlist.php");
    } else {
        $postid = $_GET['editpostid'];
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Post</h2>
                <div class="block">

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $tittle = mysqli_real_escape_string($db->link, $_POST['tittle']);
                $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
                $body = mysqli_real_escape_string($db->link, $_POST['body']);
                $author = mysqli_real_escape_string($db->link, $_POST['author']);
                $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
                $userid = mysqli_real_escape_string($db->link, $_POST['userid']);

                $permited = array('jpg', 'png', 'jpeg', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10) .'.'.$file_ext;
                $uploded_image = "uploads/" . $unique_image;

                if ($tittle == "" || $cat == "" || $body == "" || $author == "" || $tags == ""){
                    echo "<span class='error'>Filed must not be empty !!</span>"; 
                } else {
                    if (!empty($file_name)) {
                        if ($file_size > 1048567) {
                            echo "<span class='error'>Image size should be less then 1 MB.</span>";
                        } elseif (in_array($file_ext, $permited) === false) {
                            echo "<span class='error'>You can only upload " . implode(', ', $permited). "</span>";
                        } else {
                            move_uploaded_file($file_tmp, $uploded_image);
                            $query = "UPDATE tbl_post SET
                                cat = '$cat',
                                tittle = '$tittle',
                                body = '$body',
                                image = '$uploded_image',
                                author = '$author',
                                tags = '$tags',
                                userid = '$userid'
                                WHERE id = '$postid'
                            ";
                            $inserted_rows = $db->update($query);
                            if ($inserted_rows) {
                                echo "<span class='success'>Post uploaded successfully.</span>";
                            } else {
                                echo "<span class='error'>Something is worng! Post doesn't uploaded.</span>";
                            }
                        }
                    } else {
                        $query = "UPDATE tbl_post SET
                                cat = '$cat',
                                tittle = '$tittle',
                                body = '$body',
                                author = '$author',
                                tags = '$tags',
                                userid = '$userid' WHERE id = '$postid'
                            ";
                            $inserted_rows = $db->update($query);
                            if ($inserted_rows) {
                                echo "<span class='success'>Post uploaded successfully.</span>";
                            } else {
                                echo "<span class='error'>Something is worng! Post doesn't uploaded.</span>";
                            }
                        }
                    }
            }
        ?>
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
        
        <?php
            $query = "SELECT * FROM tbl_post WHERE id='$postid' ORDER BY id DESC";
            $post = $db->select($query);
            if ($post) {
                while ($uppost = $post->fetch_assoc()) {
        ?>

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="tittle" autocomplete="off" value="<?php echo $uppost['tittle']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
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
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $uppost['image']; ?>" height="120px" width="120px"></br>
                                <input type="file" autocomplete="off" name="image"/>
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $uppost['body']; ?>
                                </textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" autocomplete="off" value="<?php echo $uppost['author']; ?>" class="medium" />
                                <input type="hidden" name="userid" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" autocomplete="off" value="<?php echo $uppost['tags']; ?>" class="medium" />
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