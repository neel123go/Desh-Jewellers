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
                $msg = "This product is already added !";
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


    }
?>