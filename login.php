<?php include 'inc/header.php'; ?>
<?php
    $login = session::get("login");
    if ($login == true) {
        echo "<script>window.location = 'index.php'; </script>";
    }
?>

    <div class="signupform">
        <div class="container">
            <div class="title">Coustomer Login</div>
            <p>If you are already registered, please log in.</p>

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
                $customerlog = $cmr->customerlog($_POST);
            }
            if (isset($customerlog)) {
                echo $customerlog;
            }
        ?>

            <form action="" method="post">
                <div class="user-details no-scroll">

                    <div class="input-box">
                        <span class="details">Email Address</span>
                        <input type="text" name="email" autocomplete="off" placeholder="Email Address">
                    </div>

                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="password" autocomplete="off" placeholder="Password">
                    </div>
                    
                    <div class="forget">
                        <a href="#">Forgot your password?</a>
                    </div>

                </div>

                    <div class="button">
                        <input type="submit" name="login">
                    </div>

                    <div class="account">
                        <span>No account yet?<a href="signup.php"> Create An Account</a></span>
                    </div>

            </form>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>