<?php
require_once 'dao/CarTypeDao.php';

$carTypeDao = new CarTypeDao();

// Novi tipovi auta
$type1 = ['name' => 'Crossover'];
$type2 = ['name' => 'Convertible'];

// Dodavanje prvog tipa
echo "<h3>Dodavanje tipa: Crossover</h3>";
$added1 = $carTypeDao->add($type1);
echo "<pre>";
print_r($added1);
echo "</pre>";

// Dodavanje drugog tipa
echo "<h3>Dodavanje tipa: Convertible</h3>";
$added2 = $carTypeDao->add($type2);
echo "<pre>";
print_r($added2);
echo "</pre>";

// Prikaz svih tipova
echo "<h3>Svi tipovi auta:</h3>";
$all = $carTypeDao->get_all();
echo "<pre>";
print_r($all);
echo "</pre>";

// Dohvati drugi tip po ID
$type2_id = $added2['id'];
echo "<h3>Dohvatanje po ID = $type2_id:</h3>";
$fetched = $carTypeDao->get_by_id($type2_id);
echo "<pre>";
print_r($fetched);
echo "</pre>";

// Ažuriranje drugog tipa
$update = ['name' => 'Roadster'];
echo "<h3>Ažuriranje tipa ID = $type2_id u 'Roadster':</h3>";
$updated = $carTypeDao->update($update, $type2_id);
echo "<pre>";
print_r($updated);
echo "</pre>";

// Brisanje prvog tipa
$type1_id = $added1['id'];
echo "<h3>Brisanje tipa sa ID = $type1_id:</h3>";
$carTypeDao->delete($type1_id);

// Provjera da li je obrisan
echo "<h3>Provjera nakon brisanja tipa ID = $type1_id:</h3>";
$check = $carTypeDao->get_by_id($type1_id);
echo "<pre>";
print_r($check);
echo "</pre>";
