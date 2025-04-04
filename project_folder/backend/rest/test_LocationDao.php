<?php
require_once 'dao/LocationDao.php';

$locationDao = new LocationDao();

// Nova lokacija za testiranje
$newLocation = [
    'name' => 'Test Grad',
    'address' => 'Test Ulica 123'
];

// Dodavanje lokacije
echo "<h3>Dodavanje nove lokacije:</h3>";
$added = $locationDao->add($newLocation);
echo "<pre>";
print_r($added);
echo "</pre>";

// Dohvatanje svih lokacija
echo "<h3>Sve lokacije:</h3>";
$all = $locationDao->get_all();
echo "<pre>";
print_r($all);
echo "</pre>";

// Dohvatanje lokacije po ID
$loc_id = $added['id'];
echo "<h3>Dohvatanje lokacije po ID = $loc_id:</h3>";
$loc = $locationDao->get_by_id($loc_id);
echo "<pre>";
print_r($loc);
echo "</pre>";

// Ažuriranje lokacije
$updatedData = [
    'name' => 'Izmijenjeni Grad',
    'address' => 'Nova Adresa 456'
];
echo "<h3>Ažuriranje lokacije:</h3>";
$updated = $locationDao->update($updatedData, $loc_id);
echo "<pre>";
print_r($updated);
echo "</pre>";

// Brisanje lokacije
echo "<h3>Brisanje lokacije sa ID = $loc_id:</h3>";
$locationDao->delete($loc_id);

// Provjera da li je obrisana
echo "<h3>Provjera nakon brisanja:</h3>";
$deletedCheck = $locationDao->get_by_id($loc_id);
echo "<pre>";
print_r($deletedCheck);
echo "</pre>";
