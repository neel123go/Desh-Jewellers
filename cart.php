<?php include 'inc/header.php'; ?>
<?php
    if (isset($_GET['delid'])) {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delid']);
        $delcart = $ct->deletecart($id);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$quantity = $_POST['quantity'];
        $cartId = $_POST['cartId'];
		$updatecart = $ct->updatecartquantity($quantity, $cartId);
	}
?>

    
    <div class="cart-page">
        <table>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>

        <?php 
            $getpro = $ct->getcartpro();
            if ($getpro) {
                $sum = 0;
                while ($result = $getpro->fetch_assoc()) {
        ?>

            <tr class="cart-content">
                <td>
                    <div class="cart-info">
                        <img src="admin/<?php echo $result['image']; ?>">
                        <div class="text">
                            <p><?php echo $result['productName']; ?></p>
                            <small>Price: <?php echo $result['price']; ?> Tk</small>
                            <br>
                            <a onclick="return confirm('Are you sure to delete this product ?')" href="?delid=<?php echo $result['cartId']; ?>">Remove</a>
                        </div>
                    </div>
                </td>
                <td><?php echo $result['categoryName']; ?></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>">
                        <input type="number" name="quantity" value="<?php echo $result['quantity']; ?>" min="1" max="5">
                        <input type="submit" value="Update">
                    </form>
                </td>
                <td><span>Price: </span>৳ <?php 
                                            $total = $result['price'] * $result['quantity'];
                                            echo $total; 
                                        ?> Tk</td>
            </tr>
            
        <?php
            $sum = $sum + $total;
        } } else { ?>

        <div class="empty">
            <h4>Your cart is currently empty.</h4>
            <a href="index.php">Continue Shoping</a>
        </div>

        <?php } ?>

        </table>

        <div class="total-price">
            <div class="main-section-total">
                <div class="text12">
                    <h3>sub total: </h3>
                    <span>৳ <?php echo $sum; ?> Tk</span>
                </div>
                
                <div class="text12">
                    <h3>vat : </h3>
                    <span>৳ 10 Tk</span>
                </div>
                
                <div class="text12">
                    <h3>total : </h3>
                    <span>৳ <?php
                            $vat = $sum + 10;
                            echo $vat;
                        ?> Tk
                    </span>
                </div>
            </div>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>