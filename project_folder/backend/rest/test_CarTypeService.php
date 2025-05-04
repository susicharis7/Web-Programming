<?php
require_once __DIR__ . '../services/CarTypeService.php';

$carTypeService = new CarTypeService();

echo "<h3>Adding car type:</h3><pre>";
try {
    $newType = ['name' => 'Electric SUV'];
    $added = $carTypeService->add_car_type($newType);
    print_r($added);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    $added = null;
}
echo "</pre>";

echo "<h3>Getting car type by name:</h3><pre>";
try {
    $found = $carTypeService->get_by_name('Electric SUV');
    print_r($found);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
echo "</pre>";

if ($added) {
    echo "<h3>Updating car type:</h3><pre>";
    try {
        $added['name'] = 'Luxury SUV';
        $updated = $carTypeService->update_car_type($added['id'], $added);
        print_r($updated);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    echo "</pre>";
}

echo "<h3>All car types:</h3><pre>";
try {
    print_r($carTypeService->get_all());
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
echo "</pre>";
