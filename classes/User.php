<?php
    include_once './lib/Database.php';
    include_once './helper/Format.php';
?>

<?php
    class User{
        private $db;
        private $fr;

        public function __construct(){
            $this->db = new Database();
            $this->fr = new Format();
        }

    }
?>