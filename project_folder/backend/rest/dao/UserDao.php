<?php
require_once __DIR__ . '/BaseDao.php';

class UserDao extends BaseDao {
    protected $table_name;

    public function __construct() {
        $this->table_name = "users";
        parent::__construct($this->table_name);
    }

    public function get_all() {
        return $this->query("SELECT * FROM " . $this->table_name, []);
    }

    public function get_by_id($id) {
        return $this->query_unique("SELECT * FROM " . $this->table_name . " WHERE id = :id", ['id' => $id]);
    }

    public function get_user_by_email($email){
        return $this->query_unique("SELECT * FROM " . $this->table_name . " WHERE email = :email", ['email' => $email]);
    }
}

?>
