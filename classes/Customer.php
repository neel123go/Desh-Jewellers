<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helper/Format.php');
?>

<?php
    error_reporting(0);
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

        public function cusproupdate($data, $id){
            $name = $this->fr->validation($data['name']);
            $name = mysqli_real_escape_string($this->db->link, $name);

            $email = $this->fr->validation($data['email']);
            $email = mysqli_real_escape_string($this->db->link, $email);

            $phone = $this->fr->validation($data['phone']);
            $phone = mysqli_real_escape_string($this->db->link, $phone);

            $address = $this->fr->validation($data['address']);
            $address = mysqli_real_escape_string($this->db->link, $address);

            $gender = $this->fr->validation($data['gender']);
            $gender = mysqli_real_escape_string($this->db->link, $gender);

            if ($name == "" || $email == "" || $phone == "" || $address == "" || $gender == "") {
                $msg = "<span class='error'>Filed must not be empty !!</span>";
                return $msg;
            } else {
                if (strlen($name) < 4) {
                    $msg = "<span class='error'>Please, enter your Full Name</span>";
                    return $msg;
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $msg = "<span class='error'>This E-mail address is not valid.</span>";
                    return $msg;
                } elseif (strlen((string)$phone) > 11 || strlen((string)$phone) < 11) {
                    $msg = "<span class='error'>Your phone number is not valid.</span>";
                    return $msg;
                } else {
                    $query = "UPDATE tbl_customer SET
                        name = '$name',
                        email = '$email',
                        phone = '$phone',
                        address = '$address',
                        gender = '$gender'
                        WHERE id = '$id'";

                    $cusupdate = $this->db->update($query);
                    if ($cusupdate) {
                        $msg = "<span class='success'>Your account updated successfully.<span>";
                        return $msg;
                    } else {
                        $msg = "<span class='error'>Something went worng! Please try again for update your account.<span>";
                        return $msg;
                    }
                    
                }
            }
        }

        public function CusOrderUpdate($data, $id){
            $name = $this->fr->validation($data['name']);
            $name = mysqli_real_escape_string($this->db->link, $name);

            $email = $this->fr->validation($data['email']);
            $email = mysqli_real_escape_string($this->db->link, $email);

            $phone = $this->fr->validation($data['phone']);
            $phone = mysqli_real_escape_string($this->db->link, $phone);

            $address = $this->fr->validation($data['address']);
            $address = mysqli_real_escape_string($this->db->link, $address);

            if ($name == "" || $email == "" || $phone == "" || $address == "") {
                $msg = "<span class='error'>Filed must not be empty !!</span>";
                return $msg;
            } else {
                if (strlen($name) < 4) {
                    $msg = "<span class='error'>Please, enter your Full Name</span>";
                    return $msg;
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $msg = "<span class='error'>This E-mail address is not valid.</span>";
                    return $msg;
                } elseif (strlen((string)$phone) > 11 || strlen((string)$phone) < 11) {
                    $msg = "<span class='error'>Your phone number is not valid.</span>";
                    return $msg;
                } else {
                    $query = "UPDATE tbl_customer SET
                        name = '$name',
                        email = '$email',
                        phone = '$phone',
                        address = '$address'
                        WHERE id = '$id'";

                    $cusupdate = $this->db->update($query);
                    if ($cusupdate) {
                        $msg = "<span class='success'>Your account updated successfully.<span>";
                        return $msg;
                    } else {
                        $msg = "<span class='error'>Something went worng! Please try again for update your account.<span>";
                        return $msg;
                    }
                    
                }
            }
        }

        public function changepassword($data, $id){
            $prepassword = $this->fr->validation(md5(
                $data['prepassword']));
            $prepassword = mysqli_real_escape_string($this->db->link, $prepassword);

            $newpassword = $this->fr->validation($data['newpassword']);
            $newpassword = mysqli_real_escape_string($this->db->link, $newpassword);

            if ($prepassword == "" || $newpassword == "") {
                $msg = "<span class='error'>Filed must not be empty !!</span>";
                return $msg;
            } else {
                $prepass = "SELECT * FROM tbl_customer WHERE password = '$prepassword' AND id = '$id'";
                $passcheck = $this->db->select($prepass);
                if ($passcheck != false) {
                    if (strlen((string)$newpassword) < 8 || strlen((string)$newpassword) > 32) {
                        $msg = "<span class='error'>New Password must be 8-32 characters that contain numbers, letters & special character</span>";
                        return $msg;
                    } else {
                        $newmd5pass = md5($newpassword);
                        $query = "UPDATE tbl_customer SET
                        password = '$newmd5pass'
                        WHERE id = '$id'";

                        $passupdate = $this->db->update($query);
                        if ($passupdate) {
                            $msg = "<span class='success'>Your password updated successfully.<span>";
                            return $msg;
                        } else {
                            $msg = "<span class='error'>Something went worng! Please try again for update your password.<span>";
                            return $msg;
                        }
                    }
                } else {
                    $msg = "<span class='error'>Your previous password is incorrect.</span>";
                    return $msg;
                }
            }
        }





    }
?>