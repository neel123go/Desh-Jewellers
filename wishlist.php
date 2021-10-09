<?php include 'inc/header.php'; ?>
<?php
    $getdata = $pd->getWishlist();
    if ($getdata) {
?>
<?php
    if (isset($_GET['wishremove'])) {
        $wishid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['wishremove']);
        $pd->delWistlist($wishid);
    }

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cart'])) {
		$quantity = $_POST['quantity'];
        $categoryName = $_POST['catName'];
        $id = $_POST['productId'];
        $login = session::get("login");
        if ($login == ture) {
            $addtocart = $ct->addTocart($quantity, $categoryName, $id);
        } else {
            echo "<script>window.location = 'login.php'; </script>";
        }
	}

    if (!isset($_GET['id'])) {
        echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
    }
?>

    <div class="wishlist-page">
        <table>
            <tr>
                <th width="20%">Image</th>
                <th width="35%">Product Name</th>
                <th width="15%">Price</th>
                <th width="15%">Add</th>
                <th width="15%">Remove</th>
            </tr>

        <?php
            $getwishlist = $pd->getWishlist();
            if ($getwishlist) {
                $num = 0;
                while ($result = $getwishlist->fetch_assoc()) {
                    $num++;
        ?>

            <tr class="cart-content">
                <td>
                    <img src="admin/<?php echo $result['image']; ?>">
                </td>
                <td><h3><?php echo $result['productName']; ?></h3></td>
                <td><h4><span>Price: </span> <?php echo $result['price']; ?> Tk</h4></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="catName" value="<?php echo $result['catName']; ?>">
                        <input type="hidden" name="productId" value="<?php echo $result['productId']; ?>">
                        <input type="hidden" name="quantity" value="1">
                        <input type="submit" name="cart" value="Add To Cart">
                    </form>
                </td>
                <td><a  onclick="return confirm('Are you sure to delete this product ?')" href="?wishremove=<?php echo $result['productId']; ?>"><i class="fa fa-trash-o"></i></a></td>
            </tr>

        <?php
            Session::set("num", $num);
        ?>
        <?php } }?>

        </table>
    </div>

<?php } else { ?>
    <div class="empty">
        <h4>Your wishlist is currently empty.</h4>
        <a href="index.php">Continue Shoping</a>
    </div>
<?php } ?>

<?php include 'inc/footer.php'; ?>