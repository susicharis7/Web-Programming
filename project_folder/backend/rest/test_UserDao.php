<?php
require_once 'dao/UserDao.php';


$userDao = new UserDao();


$newUser = [
    'full_name' => 'Tarik Topic',
    'email' => 'topataka@bully.com',
    'phone_number' => '061-122-444',
    'address' => 'Gracanica',
    'password_hash' => password_hash('test123', PASSWORD_DEFAULT)
];

echo "<h3>Test: get_user_by_email('{$newUser['email']}')</h3>";
$existing = $userDao->get_user_by_email($newUser['email']);

echo "<pre>";
if ($existing) {
    echo "User already exists:\n";
    print_r($existing);
} else {
    echo "Adding user...\n";
    $added = $userDao->add($newUser);
    print_r($added);
}
echo "</pre>";

// Test: get_all
echo "<h3>List of all users:</h3>";
$users = $userDao->get_all();

echo "<pre>";
print_r($users);
echo "</pre>";
