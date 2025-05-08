<?php
require_once 'dao/LocationDao.php';

$locationDao = new LocationDao();


$newLocation = [
    'name' => 'Test Grad',
    'address' => 'Test Ulica 123'
];


echo "<h3>Adding new location:</h3>";
$added = $locationDao->add($newLocation);
echo "<pre>";
print_r($added);
echo "</pre>";


echo "<h3>All Locations:</h3>";
$all = $locationDao->get_all();
echo "<pre>";
print_r($all);
echo "</pre>";


$loc_id = $added['id'];
echo "<h3>Fetching location by ID = $loc_id:</h3>";
$loc = $locationDao->get_by_id($loc_id);
echo "<pre>";
print_r($loc);
echo "</pre>";


$updatedData = [
    'name' => 'Izmijenjeni Grad',
    'address' => 'Nova Adresa 456'
];
echo "<h3>Updating location:</h3>";
$updated = $locationDao->update($updatedData, $loc_id);
echo "<pre>";
print_r($updated);
echo "</pre>";


echo "<h3>Removing location with ID = $loc_id:</h3>";
$locationDao->delete($loc_id);


echo "<h3>Check after delete:</h3>";
$deletedCheck = $locationDao->get_by_id($loc_id);
echo "<pre>";
print_r($deletedCheck);
echo "</pre>";
