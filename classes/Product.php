<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helper/Format.php');
?>

<?php
    class Product{
        private $db;
        private $fr;

        public function __construct(){
            $this->db = new Database();
            $this->fr = new Format();
        }

        public function productinsert($data, $file){
            $catId = $this->fr->validation($data['catId']);
            $catId = mysqli_real_escape_string($this->db->link, $catId);

            $subcatId = $this->fr->validation($data['subcatId']);
            $subcatId = mysqli_real_escape_string($this->db->link, $subcatId);

            $body = $this->fr->validation($data['body']);
            $body = mysqli_real_escape_string($this->db->link, $body);

            $productName = $this->fr->validation($data['productName']);
            $productName = mysqli_real_escape_string($this->db->link, $productName);

            $price = $this->fr->validation($data['price']);
            $price = mysqli_real_escape_string($this->db->link, $price);

            $rating = $this->fr->validation($data['rating']);
            $rating = mysqli_real_escape_string($this->db->link, $rating);

            $type = $this->fr->validation($data['type']);
            $type = mysqli_real_escape_string($this->db->link, $type);

            $date = $this->fr->validation($data['date']);
            $date = mysqli_real_escape_string($this->db->link, $date);


            $permited = array('jpg', 'png', 'jpeg', 'gif');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_tmp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) .'.'.$file_ext;
            $uploded_image = "uploads/" . $unique_image;

            if ($catId == "" || $subcatId == "" || $file_name == "" || $rating == "" || $productName == "" || $body == "" || $price == "" || $type == "" || $date == "") {
                $msg = "<span class='error'>Filed must not be empty !!</span>";
                return $msg;
            } elseif ($file_size > 5242835) {
                $msg = "<span class='error'>Image size should be less then 5 MB.</span>";
                return $msg;
            } elseif (in_array($file_ext, $permited) === false) {
                $msg = "<span class='error'>You can only upload " . implode(', ', $permited). "</span>";
                return $msg;
            } else {
                move_uploaded_file($file_tmp, $uploded_image);
    
                $query = "INSERT INTO tbl_product(catId, subcatId, image, rating, productName, body, price, type, date) VALUES('$catId', '$subcatId', '$uploded_image', '$rating', '$productName', '$body', '$price', '$type', '$date')";

                $pdinsert = $this->db->insert($query);
                if ($pdinsert) {
                    $msg = "<span class='success'>Product uploaded successfully !<span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Something went worng! Product doesn't uploaded.<span>";
                    return $msg;
                }
            }
        }

        public function getallproduct(){
            $query = "SELECT tbl_product.*, tbl_main_category.catName, tbl_sub_category.subcatName
            FROM tbl_product
            INNER JOIN tbl_main_category
            ON tbl_product.catId = tbl_main_category.catId
            INNER JOIN tbl_sub_category
            ON tbl_product.subcatId = tbl_sub_category.catId
            ORDER BY tbl_product.productId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function deletepro($delid){
            $imgquery = "SELECT * FROM tbl_product WHERE productId = '$delid'";
            $delimg = $this->db->select($imgquery);
            if ($delimg) {
                while ($imglink = $delimg->fetch_assoc()) {
                    $delimglink = $imglink['image'];
                    unlink($delimglink);
                }
            }

            $query = "DELETE FROM tbl_product WHERE productId = '$delid'";
            $del_pro = $this->db->delete($query);
            if ($del_pro) {
                $msg = "<span class='success'>Product deleted successfully.<span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Something went worng! Product doesn't deleted.<span>";
                return $msg;
            }
        }

        public function getproductbyid($id){
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function productupdate($data, $file, $id){
            $catId = $this->fr->validation($data['catId']);
            $catId = mysqli_real_escape_string($this->db->link, $catId);

            $subcatId = $this->fr->validation($data['subcatId']);
            $subcatId = mysqli_real_escape_string($this->db->link, $subcatId);

            $body = $this->fr->validation($data['body']);
            $body = mysqli_real_escape_string($this->db->link, $body);

            $productName = $this->fr->validation($data['productName']);
            $productName = mysqli_real_escape_string($this->db->link, $productName);

            $price = $this->fr->validation($data['price']);
            $price = mysqli_real_escape_string($this->db->link, $price);

            $rating = $this->fr->validation($data['rating']);
            $rating = mysqli_real_escape_string($this->db->link, $rating);

            $type = $this->fr->validation($data['type']);
            $type = mysqli_real_escape_string($this->db->link, $type);

            $date = $this->fr->validation($data['date']);
            $date = mysqli_real_escape_string($this->db->link, $date);


            $permited = array('jpg', 'png', 'jpeg', 'gif');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_tmp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) .'.'.$file_ext;
            $uploded_image = "uploads/" . $unique_image;

            if ($catId == "" || $subcatId == "" || $rating == "" || $productName == "" || $body == "" || $price == "" || $type == "" || $date == "") {
                $msg = "<span class='error'>Filed must not be empty !!</span>";
                return $msg;
            } else {
                if (!empty($file_name)) {
                    if ($file_size > 5242835) {
                        $msg = "<span class='error'>Image size should be less then 5 MB.</span>";
                        return $msg;
                    } elseif (in_array($file_ext, $permited) === false) {
                        $msg = "<span class='error'>You can only upload " . implode(', ', $permited). "</span>";
                        return $msg;
                    } else {
                        move_uploaded_file($file_tmp, $uploded_image);

                        $query = "UPDATE tbl_product SET
                                    catId = '$catId',
                                    subcatId = '$subcatId',
                                    image = '$uploded_image',
                                    rating = '$rating',
                                    productName = '$productName',
                                    body = '$body',
                                    price = '$price',
                                    type = '$type',
                                    date = '$date'
                                WHERE productId = '$id'";
        
                        $pdupdate = $this->db->update($query);
                        if ($pdupdate) {
                            $msg = "<span class='success'>Product updated successfully !<span>";
                            return $msg;
                        } else {
                            $msg = "<span class='error'>Something went worng! Product doesn't updated.<span>";
                            return $msg;
                        }
                    }
                } else {
                        $query = "UPDATE tbl_product SET
                                    catId = '$catId',
                                    subcatId = '$subcatId',
                                    rating = '$rating',
                                    productName = '$productName',
                                    body = '$body',
                                    price = '$price',
                                    type = '$type',
                                    date = '$date'
                                WHERE productId = '$id'";
        
                        $pdupdate = $this->db->update($query);
                        if ($pdupdate) {
                            $msg = "<span class='success'>Product updated successfully !<span>";
                            return $msg;
                        } else {
                            $msg = "<span class='error'>Something went worng! Product doesn't updated.<span>";
                            return $msg;
                        }
                    }
                }
            }

    public function bestsalepd(){
        $query = "SELECT * FROM tbl_product WHERE type='1' ORDER BY productId LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }

    public function newpd(){
        $query = "SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 8";
        $result = $this->db->select($query);
        return $result;
    }

    public function loadallproduct(){
        $query = "SELECT * FROM tbl_product ORDER BY productId";
        $result = $this->db->select($query);
        return $result;
    }

    public function getsingleproduct($id){
        $query = "SELECT p.*, c.catName
                    FROM tbl_product as p, tbl_main_category as c
                    WHERE p.catId = c.catId AND p.productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getprobycat($id){
        $catId = mysqli_real_escape_string($this->db->link, $id);
        $query = "SELECT * FROM tbl_product WHERE subcatId = '$catId'";
        $result = $this->db->select($query);
        return $result;
    }







    }
?>