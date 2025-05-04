<?php
require_once __DIR__ . '/BaseDao.php';

class LocationDao extends BaseDao {
    protected $table_name;

    public function __construct() {
        $this->table_name = "locations";
        parent::__construct($this->table_name);
    }


    public function get_by_name($name) {
        return $this->query_unique("SELECT * FROM locations WHERE name = :name", ['name' => $name]);
    }
    



}