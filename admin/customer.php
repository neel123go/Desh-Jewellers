<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../Classes/Customer.php'); 
?>
<?php
    if (!isset($_GET['cusId']) || $_GET['cusId'] == NULL) {
        echo "<script>window.location = 'catlist.php'; </script>";
    } else {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['cusId']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script>window.location = 'inbox.php'; </script>";
	}
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock">

        <?php
            $cum = new Customer();
            $getCusdetails = $cum->getuserpro($id);
            if ($getCusdetails) {
                while ($result = $getCusdetails->fetch_assoc()) {
        ?>

                 <form action="" method="post">
                    <table class="form">			
                        <tr>
                            <td>Name</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>Address</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['address']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>Phone Number</td>
                            <td>
                                <input type="text" readonly value="<?php echo '0'.$result['phone']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>Gender</td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['gender']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Back" />
                            </td>
                        </tr>
                    </table>
                    </form>

        <?php } } ?>

                </div>
            </div>
        </div>
    
<?php include 'inc/footer.php'; ?>