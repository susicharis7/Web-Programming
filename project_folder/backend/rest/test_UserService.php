<?php
require_once __DIR__ . '../services/UserService.php';

$userService = new UserService();

echo "<h3>Adding user:</h3><pre>";
try {
    $newUser = [
        'full_name' => 'Tarik Jasenko',
        'email' => 'tarik@ibu.edu.ba',
        'phone_number' => '062-123-456',
        'address' => 'Sarajevo',
        'password_hash' => password_hash('jasamtarik123_', PASSWORD_DEFAULT)
    ];

    $addedUser = $userService->add_user($newUser);
    print_r($addedUser);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    $addedUser = null;
}
echo "</pre>";

echo "<h3>Authentication test:</h3><pre>";
try {
    $email = 'tarik@ibu.edu.ba';
    $enteredPassword = 'jasamtarik123_';

    $user = $userService->get_user_by_email($email);
    if ($user && password_verify($enteredPassword, $user['password_hash'])) {
        echo "Login successful.\n";
        print_r($user);
    } else {
        echo "Login failed: Incorrect credentials.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
echo "</pre>";

if ($addedUser) {
    echo "<h3>Updating user:</h3><pre>";
    try {
        $addedUser['full_name'] = 'Tarik J.';
        $updated = $userService->update_user($addedUser['id'], $addedUser);
        print_r($updated);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    echo "</pre>";
}

echo "<h3>All users:</h3><pre>";
print_r($userService->get_all());
echo "</pre>";