<?php include 'inc/header.php'; ?>
<?php
    if (isset($_GET['wishlistid'])) {
        $wishid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['wishlistid']);
        $addtowishlist = $pd->addToWistlist($wishid);
    }

    if (isset($_GET['cartid'])) {
        $cartid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['cartid']);
        $login = session::get("login");
        if ($login == ture) {
            $addtocartlist = $ct->addTocartonclick($cartid);
        } else {
            echo "<script>window.location = 'login.php'; </script>";
        }
        
    }
?>

    <!-- STRAT SLIDER PART -->
    <h2 class="slider-heading"><span>Explore</span> The New Arrivals</h2>
    <section class="slider">
        <div class="bodycontainer">
            <div class="wrapper">
                <div class="carousel owl-carousel">

            <?php
                $getnewpd = $pd->newpd();
                if ($getnewpd) {
                    while ($result = $getnewpd->fetch_assoc()) {
            ?>

                    <a href="details.php?proid=<?php echo $result['productId']; ?>"><div class="card"><img src="admin/<?php echo $result['image']; ?>"></div></a>

            <?php } } ?>

                </div>
            </div>
        </div>
    </section>
    <!-- END SLIDER PART -->

    <section class="best-sales" id="bestsale">
        <div class="bodycontainer">
            <h2 class="heading"><span style="color: #333;font-family: 'Roboto Mono', monospace;font-size:40px;">best</span> sales</h2>
            <div class="main">

            <?php
                $getbspd = $pd->bestsalepd();
                if ($getbspd) {
                    while ($result = $getbspd->fetch_assoc()) {
            ?>

                <div class="card">
                    <div class="imgbox">
                        <img src="admin/<?php echo $result['image']; ?>" alt="">
                        <ul class="action">
                            <a href="?wishlistid=<?php echo $result['productId']; ?>">
                                <li>
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    <span>Add to Wishlist</span>
                                </li>
                            </a>

                            <a href="?cartid=<?php echo $result['productId']; ?>">
                                <li class="sec">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span>Add to Cart</span>
                                </li>
                            </a>

                            <a href="details.php?proid=<?php echo $result['productId']; ?>">
                                <li class="thi">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    <span>View Details</span>
                                </li>
                            </a>
                        </ul>
                    </div>

                    <div class="content">
                        <div class="product-name">
                            <h3><?php echo $result['productName']; ?></h3>
                        </div>
                        <div class="price">
                            <h2>৳ <?php echo $result['price']; ?></h2>
                            <div class="rateing">
                                <span style="color:#fff;">(<?php echo $result['rating']; ?>)</span>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star gray" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } } ?>
            
            </div>
        </div>
    </section>


    <section class="products">
        <div class="bodycontainer">
            <h2 class="heading"><span style="color: #333;font-family: 'Roboto Mono', monospace;font-size:35px;">all</span> products</h2>
            <div class="wrapper">
                <div class="carousel2 owl-carousel">

            <?php
                $getallpd = $pd->loadallproduct();
                if ($getallpd) {
                    while ($result = $getallpd->fetch_assoc()) {
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
                            <a href="?wishlistid=<?php echo $result['productId']; ?>">
                                <li>
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </li>
                            </a>

                            <a href="?cartid=<?php echo $result['productId']; ?>">
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
                    
            <?php } } ?>

                </div>
            </div>

            <div class="wrapper">
                <div class="carousel2 owl-carousel">

            <?php
                $getallpd = $pd->loadallproduct();
                if ($getallpd) {
                    while ($result = $getallpd->fetch_assoc()) {
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
                            <a href="?wishlistid=<?php echo $result['productId']; ?>">
                                <li>
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </li>
                            </a>

                            <a href="?cartid=<?php echo $result['productId']; ?>">
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
                    
            <?php } } ?>

                </div>
            </div>
            
            <div class="btn">
                <a href="product.php">show more</a>
            </div>
        </div>
    </section>

<?php include 'inc/footer.php'; ?>