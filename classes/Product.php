<?php
    include_once '../lib/Database.php';
    include_once '../helper/Format.php';
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



    }
?>