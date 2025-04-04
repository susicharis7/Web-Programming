<?php
require_once 'dao/UserDao.php';

// Inicijalizuj DAO
$userDao = new UserDao();

// Novi korisnik
$newUser = [
    'full_name' => 'Tarik Topic',
    'email' => 'topataka@bully.com',
    'phone_number' => '061-122-444',
    'address' => 'Gracanica',
    'password_hash' => password_hash('test123', PASSWORD_DEFAULT)
];

// Test: get_user_by_email
echo "<h3>Test: get_user_by_email('{$newUser['email']}')</h3>";
$existing = $userDao->get_user_by_email($newUser['email']);

echo "<pre>";
if ($existing) {
    echo "Korisnik već postoji:\n";
    print_r($existing);
} else {
    echo "Dodajemo korisnika...\n";
    $added = $userDao->add($newUser);
    print_r($added);
}
echo "</pre>";

// Test: get_all
echo "<h3>Lista svih korisnika:</h3>";
$users = $userDao->get_all();

echo "<pre>";
print_r($users);
echo "</pre>";
