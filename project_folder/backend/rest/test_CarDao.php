<?php
require_once 'dao/CarDao.php';

$carDao = new CarDao();

// Dostupan automobil
$newCar = [
    'brand' => 'Bugatti',
    'model' => 'Chiron',
    'year' => 2023,
    'price_per_day' => 595.50,
    'available' => 1,
    'car_type_id' => 1 // Provjeri da ovaj ID postoji u car_types
];

// Nedostupan automobil
$newUnavailableCar = [
    'brand' => 'Audi',
    'model' => 'Q7',
    'year' => 2022,
    'price_per_day' => 120.00,
    'available' => 0,
    'car_type_id' => 1 // Isto, mora postojati
];

// Dodavanje dostupnog automobila
echo "<h3>Dodavanje dostupnog automobila:</h3>";
$addedAvailable = $carDao->add($newCar);
echo "<pre>";
print_r($addedAvailable);
echo "</pre>";

// Dodavanje nedostupnog automobila
echo "<h3>Dodavanje nedostupnog automobila:</h3>";
$addedUnavailable = $carDao->add($newUnavailableCar);
echo "<pre>";
print_r($addedUnavailable);
echo "</pre>";

// Prikaz svih automobila
echo "<h3>Svi automobili:</h3>";
$all = $carDao->get_all();
echo "<pre>";
print_r($all);
echo "</pre>";

// Prikaz dostupnih automobila
echo "<h3>Dostupni automobili (available = true):</h3>";
$available = $carDao->get_available();
echo "<pre>";
print_r($available);
echo "</pre>";

// Dohvati jedan auto po ID-u
$car_id = $addedAvailable['id'];
echo "<h3>Dohvati automobil po ID = $car_id:</h3>";
$car = $carDao->get_by_id($car_id);
echo "<pre>";
print_r($car);
echo "</pre>";
