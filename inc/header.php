<?php 
    include 'lib/Session.php';
    Session::init();

    include 'lib/Database.php';
    include 'helper/Format.php';

    spl_autoload_register(function($class){
        include_once "classes/".$class.".php";
    });

    $db = new Database();
    $fm = new Format();
    $pd = new Product();
    $ct = new Cart();
    $cat = new Category();
    $cmr = new Customer();
?>

<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GTM");
    header("Cache-Control: max-age=2592000");
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>দেশ জুয়ের্লাস</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/x-icon" href="photos/logo_32x32.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="jquery.nice-number.css">

    <!-- OWL SLIDER START -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    
    <!-- OWL SLIDER END -->

</head>
<body>
    
    <header>
        <div class="header">
            <div class="header-top">
                <a href="index.php">
                    <div class="logo">
                        <img src="assets/logo_32x32.jpg" alt="logo">
                        <h1>Dash Jewellers</h1>
                    </div>
                </a>

                <div class="search-area">
                    <input type="text" placeholder="Search entier store here..">
                    <i class="fa fa-search"></i>
                </div>

                <div class="icon">
                    <a href="wishlist.php">
                        <div class="wishlist">
                            <i class="fa fa-heart-o"></i>
                            <small>(0)</small>
                            <p> wishlist</p>
                        </div>
                    </a>
                    
                    <a href="cart.php">
                        <div class="cart">
                            <img src="assets/carticon.png">
                            <small>(<?php
                                    $getdata = $ct->checkcarttable();
                                    if ($getdata) {
                                        $cartnum = session::get("i");
                                        echo $cartnum;
                                    } else {
                                        echo "0";
                                    }
                                    
                                ?>)</small>
                            <p> My cart</p>
                        </div>
                    </a>

                    <div class="login">

            <?php
                $login = session::get("login");
                if ($login == true) { ?>
                    <a href="profile.php"><img src="assets/account.png"></a>
            <?php } else { ?>
                    <a href="login.php"><img src="assets/account.png"></a>
            <?php } ?>


                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom">
            <div class="container">
                <div class="sec-header">
                    <div class="category">
                        <nav>
                            <label for="btn" class="button"><span class="fa fa-list listicon"></span>category<span class="fa fa-caret-down arrowicon"></span>
                            </label>
                            <input type="checkbox" id="btn">
            
                            <ul class="menu">

            

                                <li>
                                    <label for="btn-1" class="first">Gold
                                        <span class="fa fa-caret-down"></span>
                                    </label>
                                    <input type="checkbox" id="btn-1">
                                   
                                    <ul>
            <?php
                $getgoldcart = $cat->getgoldcart();
                if ($getgoldcart) {
                    while ($result = $getgoldcart->fetch_assoc()) {
            ?>
                                        <li><a href="product.php?categoryid=<?php echo $result['catId']; ?>"><?php echo $result['subcatName']; ?></a></li>

            <?php } } ?>

                                    </ul>
                                </li>

                                <li>
                                    <label for="btn-2" class="first">Gold Plate
                                        <span class="fa fa-caret-down"></span>
                                    </label>
                                    <input type="checkbox" id="btn-2">
                                   
                                    <ul>
            <?php
                $getgoldplatecart = $cat->getgoldplatecart();
                if ($getgoldplatecart) {
                    while ($result = $getgoldplatecart->fetch_assoc()) {
            ?>
                                        <li><a href="product.php?categoryid=<?php echo $result['catId']; ?>"><?php echo $result['subcatName']; ?></a></li>

            <?php } } ?>

                                    </ul>
                                </li>


                            </ul>
                        </nav>
                    </div>
    
                    <div class="navbar">
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#bestsale">best sales</a></li>
                            <li><a href="#">new collection</a></li>
                            <li><a href="#">offers</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>