<?php

    require_once("User.php");
    interface IUserDAO
    {
        public function buildUser($data);
        public function create(User $user, $authUser = false);
        public function update(User $user);
        public function verifyToken($protected = false);
        public function setTokenSession($token, $redirect = true);
        public function authenticateUser($email, $password);
        public function findByToken($token);
        public function findByEmail($email);
        public function findById($id);
        public function destroyToken();
        public function changePassword(User $user);
    }
?>