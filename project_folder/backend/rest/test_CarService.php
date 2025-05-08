<?php
require_once __DIR__ . '../services/CarService.php';

$carService = new CarService();

echo "<h3>Adding a valid car:</h3><pre>";
try {
    $newCar = [
        'brand' => 'Toyota',
        'model' => 'Corolla',
        'year' => 2024,
        'price_per_day' => 75,
        'available' => 1,
        'car_type_id' => 1
    ];
    $addedCar = $carService->add_car($newCar);
    print_r($addedCar);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    $addedCar = null;
}
echo "</pre>";

echo "<h3>Trying to add unavailable car:</h3><pre>";
try {
    $invalidCar = [
        'brand' => 'Lada',
        'model' => 'Niva',
        'price_per_day' => 50,
        'available' => 0,
        'car_type_id' => 1
    ];
    $carService->add_car($invalidCar);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
echo "</pre>";

echo "<h3>Fetching cars by brand (Toyota):</h3><pre>";
try {
    $results = $carService->get_by_brand('Toyota');
    print_r($results);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
echo "</pre>";

echo "<h3>Fetching all available cars:</h3><pre>";
try {
    $availableCars = $carService->get_available();
    print_r($availableCars);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
echo "</pre>";

if ($addedCar) {
    echo "<h3>Updating the added car:</h3><pre>";
    try {
        $addedCar['model'] = 'Corolla X';
        $addedCar['price_per_day'] = 80;
        $updatedCar = $carService->update_car($addedCar['id'], $addedCar);
        print_r($updatedCar);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    echo "</pre>";
}
