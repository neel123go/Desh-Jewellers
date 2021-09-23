<?php include 'inc/header.php'; ?>

<div class="bodycontainer">
    <div class="pro-details-page">
        <div class="detail-l-sec">
            <div class="main-img">
                <img src="assets/img-1.png" id="mainimg">
            </div>
            <div class="images">
                <img src="assets/img-2.png" class="smallimg">
                <img src="assets/img-3.png" class="smallimg">
                <img src="assets/sliderimg-1.png" class="smallimg">
                <img src="assets/img-5.png" class="smallimg">
                <img src="assets/img-1.png" class="smallimg">
            </div>
        </div>
        <div class="detail-r-sec">
            <h2>Bangladeshi Wedding Neckless</h2>

            <div class="rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star gray" aria-hidden="true"></i>
            </div>

            <div class="price">
                <h2>৳ 4,500 Tk</h2>
            </div>

            <div class="details">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam ipsam vero modi temporibus accusamus nobis tempore quod quia perferendis consequatur ipsa culpa excepturi ad obcaecati a libero iure fugit corporis dolor commodi exercitationem, earum tenetur sed ea? Deserunt, rem consequuntur.</p>
            </div>

            <div class="cat">
                <span>Category</span>
                <h4>Gold Plate</h4>
            </div>

            <div class="quantity">
                <span>Quantity</span>
                <div class="number">
                    <input type="number" max="5" min="1">
                </div>
            </div>

            <div class="action-button">
                <form action="" method="post">
                    <input type="submit" value="Add to wishlist">
                    <input type="submit" value="Add to cart">
                </form>
            </div>
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