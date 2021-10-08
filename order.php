<?php include 'inc/header.php'; ?>
<?php
    $login = session::get("login");
    if ($login == false) {
        echo "<script>window.location = 'login.php'; </script>";
    }
?>

<section class="order-page">
    <div class="main-content">

    <?php 
        $getpro = $ct->getcartpro();
        if ($getpro) {
            $i = 0;
            $prono = 0; 
            $sum = 0;
            while ($result = $getpro->fetch_assoc()) {
                $i++;
                $prono = $prono + $result['quantity'];
                $item = $prono;
    ?> 

        <div class="table-one">
            <div class="img">
                <img src="admin/<?php echo $result['image']; ?>">
            </div>

            <div class="pro-name">
                <h3><?php echo $result['productName']; ?></h3>
                <p><?php echo $result['categoryName']; ?></p>
            </div>

            <div class="price">
                <h4>Price</h4>
                <p>৳ <?php 
                        $total = $result['price'] * $result['quantity'];
                        echo $total; 
                    ?><span> Tk</span></p>
            </div>

            <div class="quantity">
                <h4>Quantity</h4>
                <p><?php echo $result['quantity']; ?></p>
            </div>
        </div>

    <?php
        $sum = $sum + $total;
        Session::set("i", $i);
    ?>
    <?php } } ?>

    </div>


    <div class="table-two">
        <div class="order-form">
        <h3>Shipping</h3>

        <?php
            $id = session::get("loginid");
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
                $profileupdate = $cmr->CusOrderUpdate($_POST, $id);
            }
            if (isset($profileupdate)) {
                echo $profileupdate;
            }
        ?>

        <?php
            $getuser = $cmr->getuserpro($id);
            if ($getuser) {
                while ($value = $getuser->fetch_assoc()) {
        ?>

            <form action="" method="post">
                <div class="user-details">

                    <div class="input-fild">
                        <span>Name:</span>
                        <input type="text" name="name" value="<?php echo $value['name']; ?>" autocomplete="off">
                    </div>

                    <div class="input-fild">
                        <span>Address:</span>
                        <input type="text" name="address" value="<?php echo $value['address']; ?>" autocomplete="off">
                    </div>

                    <div class="input-fild">
                        <span>Phone:</span>
                        <input type="text" name="phone" value="<?php echo '0'.$value['phone']; ?>" autocomplete="off">
                    </div>

                    <div class="input-fild">
                        <span>Email:</span>
                        <input type="text" name="email" value="<?php echo $value['email']; ?>" autocomplete="off">
                    </div>

                    <div class="submit">
                        <input type="submit" name="update" value="Update">
                    </div>

                </div>
            </form>

        <?php } } ?>

            <h3>Order Summary</h3>

            <div class="order-summary">
                <div class="input-fild">
                    <span>Items:</span>
                    <input type="text" readonly placeholder="<?php echo $item; ?>">
                </div>

                <div class="input-fild">
                    <span>Subtotal:</span>
                    <input type="text" readonly placeholder="৳ <?php echo $sum; ?> Tk">
                </div>
                
                <div class="input-fild">
                    <span>Vat:</span>
                    <input type="text" readonly placeholder="৳ 10 Tk">
                </div>

                <div class="input-fild">
                    <span>Total:</span>
                    <input type="text" readonly placeholder="৳ <?php
                            $vat = $sum + 10;
                            echo $vat;
                        ?> Tk">
                </div>

                
                <a href="payment.php">Proceed to Pay</a>
               
            </div>
        </div>
    </div>
</section>

<?php include 'inc/footer.php'; ?>