<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    if (Session::get("userrole") == 'Admin') {
        echo '';
    } else {
        echo "<script>window.location = 'index.php';</script>";
    }
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 

            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    error_reporting(0);
                    $username = $fm->validation($_POST['username']);
                    $password = $fm->validation(md5($_POST['password']));
                    $email = $fm->validation($_POST['email']);
                    $role = $fm->validation($_POST['role']);
                    $position = $fm->validation($_POST['position']);

                    $username = mysqli_real_escape_string($db->link, $username);
                    $password = mysqli_real_escape_string($db->link, $password);
                    $email = mysqli_real_escape_string($db->link, $email);
                    $role = mysqli_real_escape_string($db->link, $role);
                    $position = mysqli_real_escape_string($db->link, $position);

                    if (empty($username) || empty($password) || empty($role) || empty($email) || empty($position)) {
                        echo "<span class='error'>Fild must not be empty !</span>";
                    } elseif ($role == "value='Admin'") {
                        $position = '1';
                    } elseif ($role == "value='Moderator'") {
                        $position = '2';
                    } elseif ($role == "value='Post Author'") {
                        $position = '3';
                    } elseif ($role == "value='Post Editor'") {
                        $position = '4';
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo "<span class='error'>This e-mail address is not valited.</span>";
                    } else {
                        $mailquery = "SELECT * FROM tbl_user WHERE email = '$email' limit 1";
                        $mailcheck = $db->select($query);
                        
                        if ($mailcheck != false) {
                            echo "<span class='error'>This email address is already exist </span>";
                        } else {
                            $position;
                            $query = "INSERT INTO tbl_user(username, password, email, role, position) VALUES('$username', '$password', '$email', '$role', '$position')";
                            $username = $db->insert($query);
                            if ($username) {
                                echo "<span class='success'>New User created successfully.</span>";
                            } else {
                                echo "<span class='error'>Something is wornk, User dosn't created !</span>";
                            }
                        }
                    }
                }
            ?>

                 <form action="adduser.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>User Name</label>
                            </td>
                            <td>
                                <input type="text" name="username" autocomplete="off" placeholder="Enter User Name" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Password</label>
                            </td>
                            <td>
                                <input type="text" name="password" autocomplete="off" placeholder="Enter User Password" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" autocomplete="off" placeholder="Enter User e-mail address" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>User Role</label>
                            </td>
                            <td>
                                <select name="role" id="select">
                                    <option>Select User Role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Moderator">Moderator</option>
                                    <option value="Post Author">Post Author</option>
                                    <option value="Post Editor">Post Editor</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>User Position</label>
                            </td>
                            <td>
                                <input type="radio" name="position" value="1">Admin
                                <input type="radio" name="position" value="2">Moderator
                                <input type="radio" name="position" value="3">Post Author
                                <input type="radio" name="position" value="4">Post Editor
                            </td>
                        </tr>

						<tr> 
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>

<?php include 'inc/footer.php'; ?>