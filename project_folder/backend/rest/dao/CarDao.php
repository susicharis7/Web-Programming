<?php
require_once __DIR__ . '/BaseDao.php';

class CarDao extends BaseDao
{
    protected $table_name;

    public function __construct() {
        $this->table_name = "cars";
        parent::__construct($this->table_name);
    }

    // Vrati sve automobile
    public function get_all() {
        return $this->query("SELECT * FROM " . $this->table_name, []);
    }

    // Vrati automobil po ID-u
    public function get_by_id($id) {
        return $this->query_unique("SELECT * FROM " . $this->table_name . " WHERE id = :id", ['id' => $id]);
    }

    // Vrati sve dostupne automobile
    public function get_available() {
        return $this->query("SELECT * FROM " . $this->table_name . " WHERE available = TRUE", []);
    }

    
}
