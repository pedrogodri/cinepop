<?php 

    class User {
        public $id;
        public $name;
        public $lastname;
        public $email;
        public $password;
        public $image;
        public $bio;
        public $token;

        public function generateToken() {
            return bin2hex(random_bytes(50));
        }

        public function generatePassword($password) {
            return password_hash($password, PASSWORD_DEFAULT);
        }
    }

?>