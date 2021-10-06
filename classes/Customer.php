<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helper/Format.php');
?>

<?php
// error_reporting(0);
    class Customer{
        private $db;
        private $fr;

        public function __construct(){
            $this->db = new Database();
            $this->fr = new Format();
        }

        public function customerregistation($data){
            $name = $this->fr->validation($data['name']);
            $name = mysqli_real_escape_string($this->db->link, $name);

            $email = $this->fr->validation($data['email']);
            $email = mysqli_real_escape_string($this->db->link, $email);

            $password = $this->fr->validation(md5($data['password']));
            $password = mysqli_real_escape_string($this->db->link, $password);

            $phone = $this->fr->validation($data['phone']);
            $phone = mysqli_real_escape_string($this->db->link, $phone);

            $address = $this->fr->validation($data['address']);
            $address = mysqli_real_escape_string($this->db->link, $address);

            $gender = $this->fr->validation($data['gender']);
            $gender = mysqli_real_escape_string($this->db->link, $gender);

            if ($name == "" || $email == "" || $password == "" || $phone == "" || $address == "" || $gender == "") {
                $msg = "<span class='error'>Filed must not be empty !!</span>";
                return $msg;
            } else {
                $mailquery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
                $mailcheck = $this->db->select($mailquery);
                if ($mailcheck != false) {
                    $msg = "<span class='error'>This Email is already exist !</span>";
                    return $msg;
                } else {
                    if (strlen((string)$password) < 8 || strlen((string)$password) > 32) {
                        $msg = "<span class='error'>Password must be 8-32 characters that contain numbers, letters & special character</span>";
                        return $msg;
                    } elseif (strlen($name) < 4) {
                        $msg = "<span class='error'>Please, enter your Full Name</span>";
                        return $msg;
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $msg = "<span class='error'>This E-mail address is not valid.</span>";
                        return $msg;
                    } elseif (strlen((string)$phone) > 11 || strlen((string)$phone) < 11) {
                        $msg = "<span class='error'>Your phone number is not valid.</span>";
                        return $msg;
                    } else {
                        $query = "INSERT INTO tbl_customer(name, email, password, phone, address, gender) VALUES('$name', '$email', '$password', '$phone', '$address', '$gender')";

                        $cusinsert = $this->db->insert($query);
                        if ($cusinsert) {
                            echo "<script>window.location = 'index.php'; </script>";
                        } else {
                            $msg = "<span class='error'>Something went worng! Please try again.<span>";
                            return $msg;
                        }
                    }
                }
            }
        }

        public function customerlog($data){
            $email = $this->fr->validation($data['email']);
            $email = mysqli_real_escape_string($this->db->link, $email);

            $password = $this->fr->validation(md5($data['password']));
            $password = mysqli_real_escape_string($this->db->link, $password);

            if (empty($email) || empty($password)) {
                $msg = "<span class='error'>Filed must not be empty !!</span>";
                return $msg;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $msg = "<span class='error'>This E-mail address is not valid.</span>";
                return $msg;
            } else {
                $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
                $result = $this->db->select($query);
                if ($result != false) {
                    $value = $result->fetch_assoc();
                    session::set("login", true);
                    session::set("loginid", $value['id']);
                    session::set("loginname", $value['name']);
                    echo "<script>window.location = 'index.php'; </script>";
                } else {
                    $msg = "<span class='error'>Your email or password is incorrect. Please try again.</span>";
                    return $msg;
                }
            }
        }

        public function getuserpro($id){
            $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }




    }
?>