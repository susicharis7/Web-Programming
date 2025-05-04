<?php
require_once __DIR__ . '../services/ReservationService.php';
require_once __DIR__ . '../services/CarService.php';

$reservationService = new ReservationService();
$carService = new CarService();

echo "<h3>Adding reservation:</h3><pre>";
try {
    $reservation = [
        'user_id' => 1,
        'car_id' => 2,
        'pickup_date' => '2025-06-01',
        'return_date' => '2025-06-05',
        'pickup_location_id' => 1,
        'return_location_id' => 2,
        'status' => 'active'
    ];
    $added = $reservationService->add_reservation($reservation);
    print_r($added);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    $added = null;
}
echo "</pre>";

if ($added) {
    echo "<h3>Cancel reservation:</h3><pre>";
    $reservationService->cancel_reservation($added['id']);
    echo "Reservation ID " . $added['id'] . " cancelled.\n";
    echo "</pre>";
}

echo "<h3>All reservations by user (user_id=1):</h3><pre>";
print_r($reservationService->get_by_user_id(1));
echo "</pre>";
