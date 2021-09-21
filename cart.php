<?php include 'inc/header.php'; ?>

    <div class="cart-page">
        <table>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>

            <tr class="cart-content">
                <td>
                    <div class="cart-info">
                        <img src="assets/img-1.png">
                        <div class="text">
                            <p>wedding Necless</p>
                            <small>Price: 2000 Tk</small>
                            <br>
                            <a href="#">Remove</a>
                        </div>
                    </div>
                </td>
                <td>Gold Plate</td>
                <td>
                    <input type="number" min="1" max="5">
                    <input type="submit" value="Update">
                </td>
                <td><span>Price: </span>৳ 2000 Tk</td>
            </tr>

            <tr class="cart-content">
                <td>
                    <div class="cart-info">
                        <img src="assets/img-2.png">
                        <div class="text">
                            <p>Choker</p>
                            <small>Price: 35,000 Tk</small>
                            <br>
                            <a href="#">Remove</a>
                        </div>
                    </div>
                </td>
                <td>Gold</td>
                <td>
                    <input type="number" min="1" max="5">
                    <input type="submit" value="Update">
                </td>
                <td><span>Price: </span>৳ 35,000 Tk</td>
            </tr>

            <tr class="cart-content">
                <td>
                    <div class="cart-info">
                        <img src="assets/img-3.png">
                        <div class="text">
                            <p>Banggle</p>
                            <small>Price: 20,500 Tk</small>
                            <br>
                            <a href="#">Remove</a>
                        </div>
                    </div>
                </td>
                <td>Daimond</td>
                <td>
                    <input type="number" min="1" max="5">
                    <input type="submit" value="Update">
                </td>
                <td><span>Price: </span>৳ 20,500 Tk</td>
            </tr>
        </table>

        <div class="total-price">
            <table>
                <tr>
                    <td>Subtotal:</td>
                    <td class="highlight">৳ 57,500 Tk</td>
                </tr>

                <tr>
                    <td>Vat:</td>
                    <td class="highlight">৳ 10 Tk</td>
                </tr>

                <tr>
                    <td>Total Price:</td>
                    <td class="highlight">৳ 57,510 Tk</td>
                </tr>
            </table>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>