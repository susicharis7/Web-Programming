<?php
require_once __DIR__ . '/../dao/ReservationDao.php';
require_once __DIR__ . '/../dao/CarDao.php';
require_once __DIR__ . '/BaseService.php';

class ReservationService extends BaseService {
    private $carDao;

    public function __construct() {
        parent::__construct(new ReservationDao());
        $this->carDao = new CarDao();
    }

    private function validate_reservation($reservation) {
        if (!isset($reservation['user_id']) || !is_numeric($reservation['user_id'])) {
            throw new Exception("User ID is required and must be numeric.");
        }

        if (!isset($reservation['car_id']) || !is_numeric($reservation['car_id'])) {
            throw new Exception("Car ID is required and must be numeric.");
        }

        if (!isset($reservation['pickup_date']) || !isset($reservation['return_date'])) {
            throw new Exception("Pickup and return date are required.");
        }

        if (!isset($reservation['pickup_location_id']) || !is_numeric($reservation['pickup_location_id'])) {
            throw new Exception("Pickup location ID is required and must be numeric.");
        }

        if (!isset($reservation['return_location_id']) || !is_numeric($reservation['return_location_id'])) {
            throw new Exception("Return location ID is required and must be numeric.");
        }

        if (!isset($reservation['status']) || !in_array($reservation['status'], ['active', 'cancelled'])) {
            throw new Exception("Status must be 'active' or 'cancelled'.");
        }

        $car = $this->carDao->get_by_id($reservation['car_id']);
        if (!$car || $car['available'] == 0) {
            throw new Exception("Car is not available for reservation.");
        }
    }

    public function add_reservation($reservation) {
        $this->validate_reservation($reservation);
        return $this->dao->add($reservation);
    }

    public function cancel_reservation($id) {
        return $this->dao->cancel_reservation($id);
    }

    public function get_by_user_id($user_id) {
        return $this->dao->get_by_user_id($user_id);
    }
}
