<?php
require_once __DIR__ . '/BaseDao.php';

class CarTypeDao extends BaseDao
{
    protected $table_name;

    public function __construct() {
        $this->table_name = "car_types";
        parent::__construct($this->table_name);
    }

    public function get_by_name($name) {
        return $this->query_unique("SELECT * FROM " . $this->table_name . " WHERE name = :name", ['name' => $name]);
    }
    
    public function get_by_name_excluding_id($name, $id) {
        return $this->query_unique("SELECT * FROM " . $this->table_name . " WHERE name = :name AND id != :id", [
            'name' => $name,
            'id' => $id
        ]);
    }
    
    
}
