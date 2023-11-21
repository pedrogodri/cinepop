<?php 

    interface IUserDAO {
        public function build($data);
        public function create(User $user, $authUser = false);
        public function update(User $user);
        public function findByToken($token);
        public function build($data);
        public function build($data);
    }

?>