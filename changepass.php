<?php include 'inc/header.php'; ?>
<?php
    if (!isset($_GET['passid']) || $_GET['passid'] == NULL) {
        echo "<script>window.location = '404.php'; </script>";
    } else {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['passid']);
    }
?>
<?php
    $login = session::get("login");
    if ($login == false) {
        echo "<script>window.location = 'login.php'; </script>";
    }
?>

    <div class="signupform">
        <div class="container">
            <div class="title">Change Password</div>

            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change'])) {
                    $changepass = $cmr->changepassword($_POST, $id);
                }

                if (isset($changepass)) {
                    echo $changepass;
                }
            ?>

            <form action="" method="post">
                <div class="user-details no-scroll">

                    <div class="input-box">
                        <span class="details">Previous Password</span>
                        <input type="password" name="prepassword" autocomplete="off"
                        placeholder="Password">
                    </div>

                    <div class="input-box">
                        <span class="details">New Password</span>
                        <input type="password" name="newpassword" autocomplete="off" placeholder="Password">
                    </div>

                </div>

                <div class="button">
                    <input type="submit" name="change" value="Change Password">
                </div>
            </form>

        </div>
    </div>

<?php include 'inc/footer.php'; ?>