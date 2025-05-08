<?php
require_once 'dao/CarDao.php';

$carDao = new CarDao();


$newCar = [
    'brand' => 'Bugatti',
    'model' => 'Chiron',
    'year' => 2023,
    'price_per_day' => 595.50,
    'available' => 1,
    'car_type_id' => 1 
];


$newUnavailableCar = [
    'brand' => 'Audi',
    'model' => 'Q7',
    'year' => 2022,
    'price_per_day' => 120.00,
    'available' => 0,
    'car_type_id' => 1 
];


echo "<h3>Adding available car:</h3>";
$addedAvailable = $carDao->add($newCar);
echo "<pre>";
print_r($addedAvailable);
echo "</pre>";


echo "<h3>Adding unavailable car:</h3>";
$addedUnavailable = $carDao->add($newUnavailableCar);
echo "<pre>";
print_r($addedUnavailable);
echo "</pre>";


echo "<h3>All cars:</h3>";
$all = $carDao->get_all();
echo "<pre>";
print_r($all);
echo "</pre>";


echo "<h3>Available cars (available = true):</h3>";
$available = $carDao->get_available();
echo "<pre>";
print_r($available);
echo "</pre>";


$car_id = $addedAvailable['id'];
echo "<h3>Get car by ID = $car_id:</h3>";
$car = $carDao->get_by_id($car_id);
echo "<pre>";
print_r($car);
echo "</pre>";
