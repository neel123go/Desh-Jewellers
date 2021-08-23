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
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
	<div class="container">
		<section id="content">

		<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$username = $fm->validation($_POST['username']);
				$password = $fm->validation(md5($_POST['password']));

				$username = mysqli_real_escape_string($db->link, $username);
				$password = mysqli_real_escape_string($db->link, $password);

				$query = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";
				$result = $db->select($query);
				if ($result != false) {
					$value = $result->fetch_assoc();

						Session::set("login", true);
						Session::set("username", $value['username']);
						Session::set("userid", $value['id']);
						Session::set("userrole", $value['role']);
						header("Location:index.php");
				} else {
					echo "<span class='success'>Your username or password are donn't matched!!</span>";
				}
			}
		?>

			<form action="login.php" method="post">
				<h1>Admin Login</h1>
				<div>
					<input type="text" placeholder="Username" autocomplete="off" required="" name="username"/>
				</div>
				<div>
					<input type="password" placeholder="Password" autocomplete="off" required="" name="password"/>
				</div>
				<div>
					<input type="submit" value="Log in" />
				</div>
			</form><!-- form -->
			<div class="button">
				<a href="forgetpass.php">Forgot Password</a>
			</div>
			<div class="button">
				<a href="http://localhost/blog_site/website.php">Infinity Tutorials</a>
			</div>
		</section>
	</div>
</body>
</html>