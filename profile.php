<?php include 'inc/header.php'; ?>
<?php
    $login = session::get("login");
    if ($login == false) {
        echo "<script>window.location = 'login.php'; </script>";
    }
?>



    <div class="signupform">
        <div class="container">
            <div class="title">Edit your account</div>

        <?php
            $id = session::get("loginid");
            $getuser = $cmr->getuserpro($id);
            if ($getuser) {
                while ($value = $getuser->fetch_assoc()) {
        ?>

            <form action="" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Full Name</span>
                        <input type="text" name="name" placeholder="<?php echo $value['name']; ?>" autocomplete="off"/>
                    </div>

                    <div class="input-box">
                        <span class="details">Email Address</span>
                        <input type="text" name="email" placeholder="<?php echo $value['email']; ?>" autocomplete="off"/>
                    </div>

                    

                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text" name="phone" placeholder="<?php echo '0'.$value['phone']; ?>" autocomplete="off"/>
                    </div>

                    <div class="big-input-box">
                        <span class="details">Address</span>
                        <input type="text" name="address" placeholder="<?php echo $value['address']; ?>" autocomplete="off"/>
                    </div>

                    <div class="gender-details">
                        <input type="radio" name="gender" value="Male" id="dot-1"<?php
                            if ($value['gender'] == 'Male') {
                                echo "checked";
                            }
                        ?>>
                        <input type="radio" name="gender" value="Female" id="dot-2"<?php
                            if ($value['gender'] == 'Female') {
                                echo "checked";
                            }
                        ?>>
                        <input type="radio" name="gender" value="Other" id="dot-3"<?php
                            if ($value['gender'] == 'Other') {
                                echo "checked";
                            }
                        ?>>
                        
                        <span class="gender-title">Gender</span>
                            <div class="category">
                                <label for="dot-1">
                                    <span class="dot one"></span>
                                    <span class="gender">Male</span>
                                </label>

                                <label for="dot-2">
                                    <span class="dot two"></span>
                                    <span class="gender">Female</span>
                                </label>

                                <label for="dot-3">
                                    <span class="dot three"></span>
                                    <span class="gender">Other</span>
                                </label>
                            </div>
                    </div>
                </div>

            <?php
                if (isset($_GET['logid'])) {
                    $delcart = $ct->delcart();
                    session::destroy();
                }
            ?>
                    <div class="button">
                        <input type="submit" name="update" value="Update">
                        <input type="submit" name="change" value="Change Password">
                        <a href="?logid=<?php echo session::get("loginid"); ?>">Logout</a>
                    </div>
                    
            </form>

        <?php } } ?>

        </div>
    </div>






<?php include 'inc/footer.php'; ?>