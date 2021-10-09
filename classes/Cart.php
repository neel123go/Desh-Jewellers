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

            $chquery = "SELECT * FROM tbl_cart WHERE productId = '$productid' AND sId = '$sid'";
            $getsamepro = $this->db->select($chquery);
            if ($getsamepro) {
                $msg = "This product is already added to cart !";
                return $msg;
            } else {
                $query = "INSERT INTO tbl_cart(sId, productId, categoryName, productName, price, quantity, image) VALUES('$sid', '$productid', '$categoryName', '$productName', '$price', '$quantity', '$image')";

                $pdinsert = $this->db->insert($query);
                if ($pdinsert) {
                    echo "<script>window.location = 'cart.php'; </script>";
                } else {
                    echo "<script>window.location = '404.php'; </script>";
                }
            }

        }

        public function getcartpro(){
            $sid = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sid'";
            $result = $this->db->select($query);
            return $result;
        }


        public function updatecartquantity($quantity, $cartId){
            $query = "UPDATE tbl_cart SET
                        quantity = '$quantity'
                        WHERE cartId = '$cartId'";
        
            $pdupdate = $this->db->update($query);
        }

        public function deletecart($id){
            $query = "DELETE FROM tbl_cart WHERE cartId = '$id'";
            $delcart = $this->db->delete($query);
        }

        public function checkcarttable(){
            $sid = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sid'";
            $result = $this->db->select($query);
            return $result;
        }

        public function delcart(){
            $sId = session_id();
            $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
            $this->db->delete($query);
        }

        public function getcusorder($id){
            $sid = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sid'";
            $getpro = $this->db->select($query);
            if ($getpro) {
                while ($result = $getpro->fetch_assoc()) {
                    $productId = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'];
                    $price = $result['price'] * $quantity;
                    $image = $result['image'];

                    $insertquery = "INSERT INTO tbl_order(loginId, productId, productName, price, quantity, image) VALUES('$id', '$productId', '$productName', '$price', '$quantity', '$image')";
                    $pdinsert = $this->db->insert($insertquery);
                }
            }
        }

        public function getorderpro($id){
            $query = "SELECT * FROM tbl_order WHERE loginId = '$id' ORDER BY productId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function checkordertbl($id){
            $query = "SELECT * FROM tbl_order WHERE loginId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getallorderpro(){
            $query = "SELECT * FROM tbl_order ORDER BY date DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function productshifted($id, $date, $price){
            $id = $this->fr->validation($id);
            $id = mysqli_real_escape_string($this->db->link, $id);

            $date = $this->fr->validation($date);
            $date = mysqli_real_escape_string($this->db->link, $date);

            $price = $this->fr->validation($price);
            $price = mysqli_real_escape_string($this->db->link, $price);

            $query = "UPDATE tbl_order SET
                status = '1'
                WHERE loginId = '$id' AND date = '$date' AND price = '$price'";
            $pdupdate = $this->db->update($query);
        }

        public function productdelete($id, $date, $price){
            $query = "DELETE FROM tbl_order WHERE loginId = '$id' AND date = '$date' AND price = '$price'";
            $this->db->delete($query);
        }

        public function productconfirm($id, $date, $price){
            $id = $this->fr->validation($id);
            $id = mysqli_real_escape_string($this->db->link, $id);

            $date = $this->fr->validation($date);
            $date = mysqli_real_escape_string($this->db->link, $date);

            $price = $this->fr->validation($price);
            $price = mysqli_real_escape_string($this->db->link, $price);

            $query = "UPDATE tbl_order SET
                status = '2'
                WHERE loginId = '$id' AND date = '$date' AND price = '$price'";
            $pdupdate = $this->db->update($query);
        }

        public function addTocartonclick($cartid){
            $catquery = "SELECT p.*, c.catName
                    FROM tbl_product as p, tbl_main_category as c
                    WHERE p.catId = c.catId AND p.productId = '$cartid'";
            $result = $this->db->select($catquery)->fetch_assoc();
            if ($result) {
                $categoryName = $result['catName'];
                $quantity = 1;
                $productid = mysqli_real_escape_string($this->db->link, $cartid);
                $sid = session_id();
    
                $squery = "SELECT * FROM tbl_product WHERE productId = '$productid'";
                $result = $this->db->select($squery)->fetch_assoc();
    
                $productName = $result['productName'];
                $price = $result['price'];
                $image = $result['image'];
    
                $chquery = "SELECT * FROM tbl_cart WHERE productId = '$productid' AND sId = '$sid'";
                $getsamepro = $this->db->select($chquery);
                if ($getsamepro) {
                    echo "<script>window.location = 'cart.php'; </script>";
                } else {
                    $query = "INSERT INTO tbl_cart(sId, productId, categoryName, productName, price, quantity, image) VALUES('$sid', '$productid', '$categoryName', '$productName', '$price', '$quantity', '$image')";
    
                    $pdinsert = $this->db->insert($query);
                    if ($pdinsert) {
                        echo "<script>window.location = 'cart.php'; </script>";
                    } else {
                        echo "<script>window.location = '404.php'; </script>";
                    }
                }
            }
        }






    }
?>