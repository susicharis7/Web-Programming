<?php
require_once __DIR__ . '/BaseDao.php';

class ReservationDao extends BaseDao
{
    protected $table_name;

    public function __construct()
    {
        $this->table_name = "reservations";
        parent::__construct($this->table_name);
    }

   
    public function get_by_user_id($user_id) {
        return $this->query("SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id", [
            'user_id' => $user_id
        ]);
    }

    public function get_by_car_id($car_id) {
        return $this->query("SELECT * FROM " . $this->table_name . " WHERE car_id = :car_id", [
            'car_id' => $car_id
        ]);
    }

    
    public function cancel_reservation($id) {
        $stmt = $this->connection->prepare("UPDATE " . $this->table_name . " SET status = 'cancelled' WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    
    public function get_active_reservations() {
        return $this->query("SELECT * FROM " . $this->table_name . " WHERE status = 'active'", []);
    }




}

