<?php include 'inc/header.php'; ?>

    <div class="signupform">
        <div class="container">
            <div class="title">Create an account</div>
            <form action="" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Full Name</span>
                        <input type="text" name="fullname" placeholder="Full Name">
                    </div>

                    <div class="input-box">
                        <span class="details">Email Address</span>
                        <input type="text" name="email" placeholder="Email Address">
                    </div>

                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="password" placeholder="Password">
                    </div>

                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text" name="number" placeholder="Phone Number">
                    </div>

                    <div class="big-input-box">
                        <span class="details">Address</span>
                        <input type="text" name="address" placeholder="Home or Office address">
                    </div>

                    <div class="gender-details">
                        <input type="radio" name="gender" id="dot-1">
                        <input type="radio" name="gender" id="dot-2">
                        <input type="radio" name="gender" id="dot-3">
                        
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

                    <div class="button">
                        <input type="submit" value="Create an account">
                    </div>
                    
            </form>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>