<?php
require_once __DIR__ . '../services/LocationService.php';

$locationService = new LocationService();

echo "<h3>Adding location:</h3><pre>";
try {
    $newLocation = [
        'name' => 'TestCity',
        'address' => '123 Main Street'
    ];
    $addedLocation = $locationService->add_location($newLocation);
    print_r($addedLocation);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    $addedLocation = null;
}
echo "</pre>";

if ($addedLocation) {
    echo "<h3>Updating location:</h3><pre>";
    try {
        $addedLocation['address'] = '456 Updated Address';
        $updated = $locationService->update_location($addedLocation['id'], $addedLocation);
        print_r($updated);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    echo "</pre>";
}

echo "<h3>Get by name:</h3><pre>";
try {
    $location = $locationService->get_by_name($addedLocation['name']);
    print_r($location);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
echo "</pre>";

echo "<h3>All locations:</h3><pre>";
try {
    $all = $locationService->get_all();
    print_r($all);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
echo "</pre>";
