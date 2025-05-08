<?php
require_once 'dao/CarTypeDao.php';

$carTypeDao = new CarTypeDao();
 
$type1 = ['name' => 'Crossover'];
$type2 = ['name' => 'Convertible'];


echo "<h3>Adding Car Type</h3>";
$added1 = $carTypeDao->add($type1);
echo "<pre>";
print_r($added1);
echo "</pre>";


echo "<h3>Adding Second Type</h3>";
$added2 = $carTypeDao->add($type2);
echo "<pre>";
print_r($added2);
echo "</pre>";


echo "<h3>All Car Types:</h3>";
$all = $carTypeDao->get_all();
echo "<pre>";
print_r($all);
echo "</pre>";


$type2_id = $added2['id'];
echo "<h3>Fetching by ID = $type2_id:</h3>";
$fetched = $carTypeDao->get_by_id($type2_id);
echo "<pre>";
print_r($fetched);
echo "</pre>";


$update = ['name' => 'Roadster'];
echo "<h3>Updating type - ID = $type2_id into 'Roadster':</h3>";
$updated = $carTypeDao->update($update, $type2_id);
echo "<pre>";
print_r($updated);
echo "</pre>";


$type1_id = $added1['id'];
echo "<h3>Brisanje tipa sa ID = $type1_id:</h3>";
$carTypeDao->delete($type1_id);

echo "<h3>Check after updating = $type1_id:</h3>";
$check = $carTypeDao->get_by_id($type1_id);
echo "<pre>";
print_r($check);
echo "</pre>";
