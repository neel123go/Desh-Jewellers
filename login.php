<?php include 'inc/header.php'; ?>

    <div class="signupform">
        <div class="container">
            <div class="title">Coustomer Login</div>
            <p>If you are already registered, please log in.</p>
            <form action="" method="post">
                <div class="user-details no-scroll">

                    <div class="input-box">
                        <span class="details">Email Address</span>
                        <input type="text" name="email" placeholder="Email Address">
                    </div>

                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    
                    <div class="forget">
                        <a href="#">Forgot your password?</a>
                    </div>

                </div>

                    <div class="button">
                        <input type="submit" value="Login">
                    </div>

                    <div class="account">
                        <span>No account yet?<a href="signup.php"> Create An Account</a></span>
                    </div>

            </form>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>