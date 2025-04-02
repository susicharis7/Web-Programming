<?php
    require_once 'UserDAO.php';

    class UserService {
        public static function getAllUsers() {
            return UserDAO::getAllUsers();
        }
    }
?>