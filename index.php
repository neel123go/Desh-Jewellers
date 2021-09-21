<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

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
                            <a href="wishlist.php?proid=<?php echo $result['productId']; ?>">
                                <li>
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    <span>Add to Wishlist</span>
                                </li>
                            </a>

                            <a href="cart.php?proid=<?php echo $result['productId']; ?>">
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
                    
            <?php } } ?>

                </div>
            </div>
            
            <div class="btn">
                <a href="#">show more</a>
            </div>
        </div>
    </section>

<?php include 'inc/footer.php'; ?>