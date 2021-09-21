<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Session.php');
    Session::checklogin();
    
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helper/Format.php');
?>

<?php
    class Adminlogin{
        private $db;
        private $fr;

        public function __construct(){
            $this->db = new Database();
            $this->fr = new Format();
        }

        public function adminLogin($adminUser, $adminPass){
            $adminUser = $this->fr->validation($adminUser);
            $adminPass = $this->fr->validation($adminPass);

            $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
            $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

            if (empty($adminUser) || empty($adminPass)) {
                $loginmsg = "Username & Password must not be empty !";
                return $loginmsg;
            } else {
                $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'";
                $result = $this->db->select($query);
                if ($result != false) {
                    $value = $result->fetch_assoc();
                    Session::set("adminlogin", true);
                    Session::set("adminId", $value['adminId']);
                    Session::set("adminName", $value['adminName']);
                    Session::set("adminUser", $value['adminUser']);
                    header("Location:dashbord.php");
                } else {
                    $loginmsg = "Username or Password not match !";
                    return $loginmsg;
                }
            }
        }
    }
?>