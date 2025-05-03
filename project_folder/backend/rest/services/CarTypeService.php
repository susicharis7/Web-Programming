<?php 
require_once __DIR__ . '/../dao/CarTypeDao.php';
require_once __DIR__ . '/BaseService.php';

class CarTypeService extends BaseService {
    public function __construct() {
        parent::__construct(new CarTypeDao());
    }

    // if we decide to add manually
    private function validate_car_type($type) {
        if(!isset($type['name']) || trim($type['name']) === '') {
            throw new Exception("Car type name is required.");
        }
    }

    public function add_car_type($type) {
        $this->validate_car_type($type);

        if($this->dao->get_by_name($type['name'])) {
            throw new Exception("Car type with name : " . $type['name'] . " already exists.");
        }

        return $this->dao->add($type);

    }

    public function update_car_type($id,$type) {
        $this->validate_car_type($type);
        return $this->dao->update($type, $id);
    }

    public function get_by_name($name) {
        return $this->dao->get_by_name($name);
    }
}


?>