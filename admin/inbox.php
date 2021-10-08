<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
	$filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/Cart.php');
    include_once ($filepath.'/../helper/Format.php');
	$ct = new Cart();
	$fm = new Format();
?>
<?php
	if (isset($_GET['shiftid'])) {
		$id = $_GET['shiftid'];
		$date = $_GET['date'];
		$price = $_GET['price'];
		$proshif = $ct->productshifted($id, $date, $price);
	}

	if (isset($_GET['delid'])) {
		$id = $_GET['delid'];
		$date = $_GET['date'];
		$price = $_GET['price'];
		$prodel = $ct->productdelete($id, $date, $price);
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Id</th>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Date</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

			<?php
				$getorderpro = $ct->getallorderpro();
				if ($getorderpro) {
					while ($result = $getorderpro->fetch_assoc()) {
			?>

						<tr class="odd gradeX">
							<td><a href="productdetails.php?proid=<?php echo $result['productId']; ?>"><?php echo $result['id']; ?></a></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['quantity']; ?></td>
							<td>৳ <?php echo $result['price']; ?> Tk</td>
							<td><?php echo $fm->formatonlydate($result['date']); ?></td>
							<td><a href="customer.php?cusId=<?php echo $result['loginId']; ?>">View Details</a></td>
			<?php if ($result['status'] == '0') { ?>
					<td><a href="?shiftid=<?php echo $result['loginId']; ?>&price=<?php echo $result['price']; ?>&date=<?php echo $result['date']; ?>">Shifted</a></td>
			<?php } elseif ($result['status'] == '1') { ?>
					<td style="color: #17303b8e;">Pending</td>
			<?php } else { ?>
					<td><a style="color: red;" href="?delid=<?php echo $result['loginId']; ?>&price=<?php echo $result['price']; ?>&date=<?php echo $result['date']; ?>">Remove</a></td>
			<?php } ?>

							
						</tr>
			<?php } } ?>

					</tbody>
				</table>
               </div>
            </div>
        </div>
		<script type="text/javascript">
	$(document).ready(function () {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
    </script>

<?php include 'inc/footer.php'; ?>
