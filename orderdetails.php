<?php include 'inc/header.php'; ?>
<?php
    $login = session::get("login");
    if ($login == false) {
        echo "<script>window.location = 'login.php'; </script>";
    }
?>
<?php
    if (isset($_GET['confirmid'])) {
		$id = $_GET['confirmid'];
		$date = $_GET['date'];
		$price = $_GET['price'];
		$procon = $ct->productconfirm($id, $date, $price);
	}

    if (isset($_GET['delid'])) {
		$id = $_GET['delid'];
		$prodel = $ct->productdeletebyid($id);
	}
?>

    <div class="order-details-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Date</th>
                <th>Status</th>
            </tr>

    <?php 
        $id = session::get("loginid");
        $getorderpro = $ct->getorderpro($id);
        if ($getorderpro) {
            $i = 0;
            while ($result = $getorderpro->fetch_assoc()) {
                $i++;
    ?>  

            <tr class="details-content">
                <td>
                    <div class="details-info">
                    <img src="admin/<?php echo $result['image']; ?>">
                        <div class="text">
                            <p><?php echo $result['productName']; ?></p>
                            <small>Price: <?php echo $result['price']; ?> Tk</small>
                        </div>
                    </div>
                </td>
                <td><span>qty: </span><?php echo $result['quantity']; ?></td>
                
                <td><span>Price: </span>৳ <?php 
                        $total = $result['price'] * $result['quantity'];
                        echo $total; 
                ?> Tk</td>
                <td><?php echo $fm->formatonlydate($result['date']); ?></td>
                <td>
                    <?php
                        if ($result['status'] == '0') {
                            echo "Pending";
                        } elseif ($result['status'] == '1'){ ?>
                            <a style="color: red;" href="?confirmid=<?php echo $id; ?>&price=<?php echo $result['price']; ?>&date=<?php echo $result['date']; ?>">Shifted</a>
                        <?php } else {
                            echo "Confirm";
                        }
                    ?>
                </td>
                
            </tr>
          
        <?php } } else {
            echo "<script>window.location = 'index.php'; </script>";
        } ?>

        </table>
    </div>

<?php include 'inc/footer.php'; ?>