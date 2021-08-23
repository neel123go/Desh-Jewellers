<?php
	include '../lib/Session.php';
	Session::checklogin();
?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>
<?php include '../config/config.php'; ?>
<?php
    $db = new Database();
    $fm = new Format();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
	<div class="container">
		<section id="content">

		<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$email = $fm->validation($_POST['email']);
				$email = mysqli_real_escape_string($db->link, $email);

				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<span style='color:rgb(243, 106, 106)'>This e-mail address is not valited.</span>";
                } else {
                    $mailquery = "SELECT * FROM tbl_user WHERE email='$email' LIMIT 1";
				    $mailcheck = $db->select($mailquery);

                    if ($mailcheck != false) {
                        while ($value = $mailcheck->fetch_assoc()) {
                            $userid = $value['id'];
                            $username = $value['username'];
                        }

                        $text = substr($email, 0, 4);
                        $randnum = rand(1234, 123456);
                        $newpass = "$text$randnum";
                        $password = md5($newpass);

                        $updatequery = "UPDATE tbl_user
                            SET
                            password = '$password'
                            WHERE id = '$userid'";
                        $updated_rows = $db->update($updatequery);
                        $to = "$email";
                        $from = "neelpaul1122@gmail.com";
                        $headers = "Infinity Tutorials";
                        $headers .= 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $subject = "Reset Your Password";
                        $message = "Your username is " .$username. "and Password is " .$newpass. "Please visit our website to login";

                        $sendmail = mail($to, $subject, $message, $headers);
                        if ($sendmail) {
                            echo "<span style='color: rgb(106, 243, 136)'>Please check your email for new password.</span>";
                        } else {
                            echo "<span style='color:rgb(243, 106, 106)'>Something is worng ! Please try again.</span>";
                        }

                    } else {
                        echo "<span style='color:rgb(243, 106, 106)'>This e-mail address is not exist.</span>";
                    }
                }
			}
		?>

			<form action="" method="post">
				<h1>Reset Password</h1>
				<div>
					<input type="text" placeholder="Email" autocomplete="off" required="" name="email"/>
				</div>
				<div>
					<input type="submit" value="Send email" />
				</div>
			</form><!-- form -->
			
			<div class="button">
				<a href="login.php">Login</a>
			</div>
		</section>
	</div>
</body>
</html>