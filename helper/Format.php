<?php
    class Format{
        public function formatdate($data){
            return date('F jS, Y, g:i a', strtotime($data));
        }

        public function textsort($text, $limit = 620){
            $text = $text. " ";
            $text = substr($text, 0, $limit);
            $text = substr($text, 0, strrpos($text, ' '));
            $text = $text . "....";
            return $text;
        }

        public function validation($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        public function title(){
            $path = $_SERVER['SCRIPT_FILENAME'];
            $title = basename($path, '.php');
            if ($title == 'website') {
                $title = 'Home';
            } elseif ($title == 'category') {
                $title = 'Category';
            } elseif ($title == 'tutorials') {
                $title = 'Tutorials';
            } elseif ($title == 'posts') {
                $title = 'Posts';
            } elseif ($title == 'connect') {
                $title = 'Connect Us';
            } elseif ($title == 'terns&condition') {
                $title = 'Terms and Conditions';
            } elseif ($title == 'privacypolicy') {
                $title = 'Privacy Policy';
            } elseif ($title == 'refundpolicy') {
                $title = 'Refund Policy';
            } elseif ($title == 'aboutus') {
                $title = 'About Us';
            }

            return $title;
        }
    }
?>