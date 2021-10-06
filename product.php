<?php include 'inc/header.php'; ?>
<?php
    if (!isset($_GET['categoryid']) || $_GET['categoryid'] == NULL) {
        echo "<script>window.location = '404.php'; </script>";
    } else {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['categoryid']);
    }
?>
    <section class="products">
        <div class="bodycontainer">
            <h2 class="heading"><span style="color: #333;font-family: 'Roboto Mono', monospace;font-size:35px;">products by</span> category</h2>

            <div class="card-product">
                <div class="main-card-content">


            <?php
                $getcatpro = $pd->getprobycat($id);
                if ($getcatpro) {
                    while ($result = $getcatpro->fetch_assoc()) {
            ?>

                    <div class="card">
                        <img src="admin/<?php echo $result['image']; ?>" alt="Slider Image - 1">
                        <div class="rateing">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star gray" aria-hidden="true"></i>
                            <p>(<?php echo $result['rating']; ?>)</p>
                        </div>

                        <div class="product-name">
                            <h3><?php echo $result['productName']; ?></h3>
                        </div>

                        <div class="product-price">
                            <h2>৳ <?php echo $result['price']; ?></h2>
                        </div>

                        <ul class="action">
                            <a href="wishlist.php?proid=<?php echo $result['productId']; ?>">
                                <li>
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </li>
                            </a>

                            <a href="cart.php?proid=<?php echo $result['productId']; ?>">
                                <li class="sec">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </li>
                            </a>

                            <a href="details.php?proid=<?php echo $result['productId']; ?>">
                                <li class="thi">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </li>
                            </a>
                        </ul>
                    </div>

            <?php } } else { ?>
                <span style="color:red; font-size: 20px; border: 1px solid red;display:block;width:100%; text-align:center; padding:20px 0;">Sorry, There is no product in this category.<span>
            <?php } ?>

                </div>
            </div>

        </div>
    </section>

<?php include 'inc/footer.php'; ?>