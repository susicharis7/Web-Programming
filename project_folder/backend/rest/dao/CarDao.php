<?php
require_once __DIR__ . '/BaseDao.php';

class CarDao extends BaseDao {
    protected $table_name;

    public function __construct() {
        $this->table_name = "cars";
        parent::__construct($this->table_name);
    }


    public function get_available() {
        return $this->query("SELECT * FROM " . $this->table_name . " WHERE available = TRUE", []);
    }

    public function get_by_brand($brand) {
        return $this->query("SELECT * FROM {$this->table_name} WHERE brand = :brand", ['brand' => $brand]);
    }    
}