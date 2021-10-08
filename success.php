<?php include 'inc/header.php'; ?>
<?php
    $login = session::get("login");
    if ($login == false) {
        echo "<script>window.location = 'login.php'; </script>";
    }
?>

    <div class="success-page">
        <div class="success-content">
            <h2>Thank you for your purchase from <span>DESH JEWELLERS</span></h2>
            <p>We recive your order successfully. Here is your order details..<a href="orderdetails.php">Visit Here</a></p>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>