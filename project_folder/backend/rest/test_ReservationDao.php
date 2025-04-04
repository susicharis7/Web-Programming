<?php
require_once 'dao/ReservationDao.php';

$reservationDao = new ReservationDao();

// Korisnici i auti (pretpostavlja se da već postoje u bazi)
$user_id = 1;
$user_id = 3;
$car_id = 2;
$car_id = 3;
$pickup_location_id = 3;
$return_location_id = 4;

// Prva rezervacija
$newReservation = [
    'user_id' => $user_id,
    'car_id' => $car_id,
    'pickup_date' => '2025-04-10',
    'return_date' => '2025-04-15',
    'pickup_location_id' => $pickup_location_id,
    'return_location_id' => $return_location_id,
    'status' => 'active'
];

// Druga rezervacija
$newSecondReservation = [
    'user_id' => $user_id,
    'car_id' => $car_id,
    'pickup_date' => '2021-04-10',
    'return_date' => '2025-11-24',
    'pickup_location_id' => $pickup_location_id,
    'return_location_id' => $return_location_id,
    'status' => 'active'
];

// Dodavanje prve rezervacije
echo "<h3> Dodavanje prve rezervacije:</h3>";
$firstAdded = $reservationDao->add($newReservation);
echo "<pre>";
print_r($firstAdded);
echo "</pre>";

// Dodavanje druge rezervacije
echo "<h3> Dodavanje druge rezervacije:</h3>";
$secondAdded = $reservationDao->add($newSecondReservation);
echo "<pre>";
print_r($secondAdded);
echo "</pre>";

// Prikaz svih rezervacija
echo "<h3> Sve rezervacije:</h3>";
$all = $reservationDao->get_all();
echo "<pre>";
print_r($all);
echo "</pre>";

// Prikaz rezervacija za korisnika sa ID = $user_id
echo "<h3> Rezervacije za user_id = $user_id:</h3>";
$userReservations = $reservationDao->get_by_user_id($user_id);
echo "<pre>";
print_r($userReservations);
echo "</pre>";

// Otkazivanje druge rezervacije ako postoji
if (isset($secondAdded['id'])) {
    $last_id = $secondAdded['id'];
    echo "<h3> Otkazivanje rezervacije sa ID = $last_id:</h3>";
    $reservationDao->cancel_reservation($last_id);

    // Prikaz statusa rezervacije nakon otkazivanja
    echo "<h3> Status nakon otkazivanja:</h3>";
    $check = $reservationDao->get_by_id($last_id);
    echo "<pre>";
    print_r($check);
    echo "</pre>";
} else {
    echo "<h3 style='color:red'>Rezervacija nije uspješno dodana – nije moguće izvršiti otkazivanje.</h3>";
}
