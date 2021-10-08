<?php include 'inc/header.php'; ?>
<?php
    $login = session::get("login");
    if ($login == false) {
        echo "<script>window.location = 'login.php'; </script>";
    }
?>
<?php
    if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
        $id = session::get("loginid");
        $getorder = $ct->getcusorder($id);
        $delcart = $ct->delcart();
        echo "<script>window.location = 'success.php'; </script>";
    }
?>
    <div class="payment">
        <h4>Select Payment Method</h4>

        <div class="payment-method">
            <a href="?orderid=order"><div class="cash">
                <img src="assets/cash-on-delivery.png">
                <p>Cash on delivery</p>
            </div></a>

            <a href="#"><div class="credit">
                <img src="assets/credit-card.png">
                <p>Credit/Debit Card</p>
            </div></a>
            
            <a href="#"><div class="bkash">
                <img src="assets/bkash.png">
                <p>Bkash</p>
            </div></a>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>