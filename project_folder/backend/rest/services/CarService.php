<?php
require_once __DIR__ . '/../dao/CarDao.php';
require_once __DIR__ . '/BaseService.php';

class CarService extends BaseService {
    

    public function __construct() {
        parent::__construct(new CarDao());
    }

    public function get_available() {
        return $this->dao->get_available();
    }
    
    public function add_car($car) {
        $this->validate_car($car);
        return $this->dao->add($car);
    }
    
    public function update_car($id, $car) {
        $this->validate_car($car);
        return $this->dao->update($car, $id);
    }
    
    public function get_by_brand($brand) {
        return $this->dao->get_by_brand($brand);
    }

    
    

    private function validate_car($car) {
        if (!isset($car['brand']) || trim($car['brand']) === '') {
            throw new Exception("Brand is required.");
        }
    
        if (!isset($car['model']) || trim($car['model']) === '') {
            throw new Exception("Model is required.");
        }
    
        if (!isset($car['price_per_day']) || !is_numeric($car['price_per_day']) || $car['price_per_day'] <= 0) {
            throw new Exception("Price per day must be a number greater than 0.");
        }
    
        if (!isset($car['available'])) {
            $car['available'] = 1; 
        }
    
        // if ($car['available'] == 0) {
        //     throw new Exception("Car must be available to be added.");
        // }
    
        if (!isset($car['car_type_id']) || !is_numeric($car['car_type_id'])) {
            throw new Exception("Car type ID must be provided and numeric.");
        }
    }

    
    
}