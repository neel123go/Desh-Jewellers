<?php include 'inc/header.php'; ?>
<?php
    if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
        echo "<script>window.location = '404.php'; </script>";
    } else {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cart'])) {
		$quantity = $_POST['quantity'];
        $categoryName = $_POST['category'];
		$addtocart = $ct->addTocart($quantity, $categoryName, $id);
	}
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])) {
		$addtowishlist = $pd->addToWistlist($id);
	}
?>

<div class="bodycontainer">
    <div class="pro-details-page">
        <div class="detail-l-sec">

        <?php
            $getproduct = $pd->getsingleproduct($id);
            if ($getproduct) {
                while ($result = $getproduct->fetch_assoc()) {
        ?>

            <div class="main-img">
                <img src="admin/<?php echo $result['image']; ?>" id="mainimg">
            </div>
            <div class="images">
                <img src="admin/<?php echo $result['image']; ?>" class="smallimg">
                <img src="admin/<?php echo $result['image']; ?>" class="smallimg">
                <img src="admin/<?php echo $result['image']; ?>" class="smallimg">
                <img src="admin/<?php echo $result['image']; ?>" class="smallimg">
                <img src="admin/<?php echo $result['image']; ?>" class="smallimg">
            </div>
        </div>
        <div class="detail-r-sec">
            <h2><?php echo $result['productName']; ?></h2>

            <div class="rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star gray" aria-hidden="true"></i>
            </div>

            <div class="price">
                <h2>৳ <?php echo $result['price']; ?> Tk</h2>
            </div>

            <div class="details">
                <p><?php echo $result['body']; ?></p>
            </div>

            <form action="" method="post">
                <div class="cat">
                    <span>Category</span>
                    <h4><?php echo $result['catName']; ?></h4>
                    <input type="hidden" name="category" value="<?php echo $result['catName']; ?>">
                </div>

                <div class="quantity">
                    <span>Quantity</span>
                    <div class="number">
                        <input type="number" name="quantity" max="5" min="1">
                    </div>
                </div>

                <div class="action-button">
                    <input type="submit" name="cart" value="Add to cart">
                    <input type="submit" name="wishlist" value="Add to wishlist">
                </div>

                <span style="color:red; margin-top:20px; text-transform: none;">
                    <?php
                        if (isset($addtocart)) {
                            echo $addtocart;
                        }
                        if (isset($addtowishlist)) {
                            echo $addtowishlist;
                        }
                    ?>
                </span>
            </form>
        <?php } } ?>

        </div>
    </div>
</div>

<script>
    var mainimg = document.getElementById("mainimg");
    var smallimg = document.getElementsByClassName("smallimg");

    smallimg[0].onclick = function(){
        mainimg.src = smallimg[0].src;
    }

    smallimg[1].onclick = function(){
        mainimg.src = smallimg[1].src;
    }

    smallimg[2].onclick = function(){
        mainimg.src = smallimg[2].src;
    }

    smallimg[3].onclick = function(){
        mainimg.src = smallimg[3].src;
    }

</script>

<?php include 'inc/footer.php'; ?>