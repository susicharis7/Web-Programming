<?php
require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/BaseService.php';

class UserService extends BaseService {
    public function __construct() {
        parent::__construct(new UserDao());
    }

    private function validate_user($user) {
        if (!isset($user['full_name']) || trim($user['full_name']) === '') {
            throw new Exception("Full name is required.");
        }

        if (!isset($user['email']) || trim($user['email']) === '') {
            throw new Exception("Email is required.");
        }

        if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        $existing = $this->dao->get_user_by_email($user['email']);
        if ($existing) {
            throw new Exception("User with this email already exists.");
        }
    }

    public function add_user($user) {
        $this->validate_user($user);
        return $this->dao->add($user);
    }

    public function update_user($id, $user) {
        if (!isset($user['full_name']) || trim($user['full_name']) === '') {
            throw new Exception("Full name is required.");
        }

        return $this->dao->update($user, $id);
    }

    public function get_user_by_email($email) {
        return $this->dao->get_user_by_email($email);
    }

    public function login($email, $password_plain) {
        $user = $this->dao->get_user_by_email($email);
        if (!$user || !password_verify($password_plain, $user['password_hash'])) {
            throw new Exception("Invalid email or password.");
        }
        return $user;
    }
}
