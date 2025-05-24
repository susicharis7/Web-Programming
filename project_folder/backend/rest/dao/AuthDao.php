<?php
require_once __DIR__ . '/BaseDao.php';

class AuthDao extends BaseDao {
    public function __construct() {
        parent::__construct("users");
    }

    public function get_user_by_email($email) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
