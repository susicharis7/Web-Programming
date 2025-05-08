<?php
require_once 'dao/ReservationDao.php';

$reservationDao = new ReservationDao();


$user_id = 1;
$user_id = 3;
$car_id = 2;
$car_id = 3;
$pickup_location_id = 3;
$return_location_id = 4;


$newReservation = [
    'user_id' => $user_id,
    'car_id' => $car_id,
    'pickup_date' => '2025-04-10',
    'return_date' => '2025-04-15',
    'pickup_location_id' => $pickup_location_id,
    'return_location_id' => $return_location_id,
    'status' => 'active'
];


$newSecondReservation = [
    'user_id' => $user_id,
    'car_id' => $car_id,
    'pickup_date' => '2021-04-10',
    'return_date' => '2025-11-24',
    'pickup_location_id' => $pickup_location_id,
    'return_location_id' => $return_location_id,
    'status' => 'active'
];


echo "<h3> Adding first reservation:</h3>";
$firstAdded = $reservationDao->add($newReservation);
echo "<pre>";
print_r($firstAdded);
echo "</pre>";


echo "<h3> Adding second reservation:</h3>";
$secondAdded = $reservationDao->add($newSecondReservation);
echo "<pre>";
print_r($secondAdded);
echo "</pre>";


echo "<h3> All reservations:</h3>";
$all = $reservationDao->get_all();
echo "<pre>";
print_r($all);
echo "</pre>";


echo "<h3> Reservations for user_id = $user_id:</h3>";
$userReservations = $reservationDao->get_by_user_id($user_id);
echo "<pre>";
print_r($userReservations);
echo "</pre>";


if (isset($secondAdded['id'])) {
    $last_id = $secondAdded['id'];
    echo "<h3> Cancelling reservation with ID = $last_id:</h3>";
    $reservationDao->cancel_reservation($last_id);

  
    echo "<h3> Status after cancelling:</h3>";
    $check = $reservationDao->get_by_id($last_id);
    echo "<pre>";
    print_r($check);
    echo "</pre>";
} else {
    echo "<h3 style='color:red'>Reservation is not added – cannot finish cancellation.</h3>";
}
