<?php include 'inc/header.php'; ?>

    <div class="signupform">
        <div class="container">
            <div class="title">Create an account</div>

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                $customerregi = $cmr->customerregistation($_POST);
            }
            if (isset($customerregi)) {
                echo $customerregi;
            }
        ?>

            <form action="" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Full Name</span>
                        <input type="text" name="name" placeholder="Full Name" autocomplete="off"/>
                    </div>

                    <div class="input-box">
                        <span class="details">Email Address</span>
                        <input type="text" name="email" placeholder="Email Address" autocomplete="off"/>
                    </div>

                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="password" placeholder="Password" autocomplete="off"/>
                    </div>

                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text" name="phone" placeholder="Phone Number" autocomplete="off"/>
                    </div>

                    <div class="big-input-box">
                        <span class="details">Address</span>
                        <input type="text" name="address" placeholder="Home or Office address" autocomplete="off"/>
                    </div>

                    <div class="gender-details">
                        <input type="radio" name="gender" value="Male" id="dot-1">
                        <input type="radio" name="gender" value="Female" id="dot-2">
                        <input type="radio" name="gender" value="Other" id="dot-3">
                        
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
                        <input type="submit" name="submit" value="Create an account">
                    </div>
                    
            </form>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>