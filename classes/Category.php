<?php
    include_once '../lib/Database.php';
    include_once '../helper/Format.php';
?>

<?php
    class Category{
        private $db;
        private $fr;

        public function __construct(){
            $this->db = new Database();
            $this->fr = new Format();
        }

        
        public function catinsert($catName){
            $catName = $this->fr->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);

            if (empty($catName)) {
                $msg = "<span style='color: red'>Category filde must not be empty !<span>";
                return $msg;
            } else {
                $query = "INSERT INTO tbl_main_category(catName) VALUES('$catName')";
                $catinsert = $this->db->insert($query);
                if ($catinsert) {
                    $msg = "<span style='color: green'>Category added successfully !<span>";
                    return $msg;
                } else {
                    $msg = "<span style='color: red'>Something went worng! Category doesn't added.<span>";
                    return $msg;
                }
            }
        }

        public function getAllcat(){
            $query = "SELECT * FROM tbl_main_category ORDER BY catId";
            $result = $this->db->select($query);
            return $result;
        }

        public function getCatbyId($id){
            $query = "SELECT * FROM tbl_main_category WHERE catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function catUpdate($catName, $id){
            $catName = $this->fr->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $id = mysqli_real_escape_string($this->db->link, $id);

            if (empty($catName)) {
                $msg = "<span style='color: red'>Pleasse, Enter a category name.<span>";
                return $msg;
            } else {
                $query = "UPDATE tbl_main_category SET
                        catName = '$catName'
                        WHERE catId = '$id'
                ";
                $update_cat = $this->db->update($query);
                if ($update_cat) {
                    $msg = "<span style='color: green'>Category updated successfully.<span>";
                    return $msg;
                } else {
                    $msg = "<span style='color: red'>Something went worng! Category doesn't updated.<span>";
                    return $msg;
                }
            }
        }

    }
?>