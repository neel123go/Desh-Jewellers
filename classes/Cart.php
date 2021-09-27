<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helper/Format.php');
?>
<?php
    class Cart{
        private $db;
        private $fr;

        public function __construct(){
            $this->db = new Database();
            $this->fr = new Format();
        }

        public function addTocart($quantity, $categoryName, $id){
            $quantity = $this->fr->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $categoryName = $this->fr->validation($categoryName);
            $categoryName = mysqli_real_escape_string($this->db->link, $categoryName);
            $productid = mysqli_real_escape_string($this->db->link, $id);
            $sid = session_id();

            $squery = "SELECT * FROM tbl_product WHERE productId = '$productid'";
            $result = $this->db->select($squery)->fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];

            $query = "INSERT INTO tbl_cart(sId, productId, categoryName, productName, price, quantity, image) VALUES('$sid', '$productid', '$categoryName', '$productName', '$price', '$quantity', '$image')";

            $pdinsert = $this->db->insert($query);
            if ($pdinsert) {
                echo "<script>window.location = 'cart.php'; </script>";
            } else {
                echo "<script>window.location = '404.php'; </script>";
            }
        }

        public function getcartpro(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }




    }
?>