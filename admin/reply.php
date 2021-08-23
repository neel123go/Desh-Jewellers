<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
        echo "<script>window.location = 'inbox.php';</script>";
    } else {
        $replyid = $_GET['msgid'];
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Reply Message</h2>

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$to = $fm->validation($_POST['toemail']);
				$from = $fm->validation($_POST['fromemail']);
				$subject = $fm->validation($_POST['subject']);
				$message = $fm->validation($_POST['message']);
                
                $mailsend = mail($to, $subject, $message, $from);
                if ($mailsend) {
                    echo "<span class='success'>Mail sent successfully.</span>";
                } else {
                    echo "<span class='error'>Something is worng! Mail doesn't sent.</span>";
                }
            }
        ?>

                <div class="block">

                 <form action="" method="post">

            <?php
                $query = "SELECT * FROM tbl_msg WHERE id='$replyid'";
                $viewmsg = $db->select($query);
                if ($viewmsg) {
                    while ($result = $viewmsg->fetch_assoc()) {
            ?>

                    <table class="form">
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" readonly name="toemail" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="fromemail" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject" placeholder="" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" readonly name="message">
                                    
                                </textarea>
                            </td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
                            </td>
                        </tr>
                    </table>

            <?php } } ?>

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