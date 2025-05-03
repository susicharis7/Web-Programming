<?php
require_once __DIR__ . '../services/CarService.php';
require_once __DIR__ . '../services/CarTypeService.php';
require_once __DIR__ . '../services/LocationService.php';
require_once __DIR__ . '../services/ReservationService.php';
require_once __DIR__ . '../services/UserService.php';

$carService = new CarService();
$carTypeService = new CarTypeService();
$locationService = new LocationService();
$reservationService = new ReservationService();
$userService = new UserService();

// CarService
echo "<h3>Trying to add car that is NOT available:</h3><pre>";
try {
    $unavailableCar = [
        'brand' => 'MalaVoliMercedesa',
        'model' => 'Ne!Moze',
        'year' => 2024,
        'price_per_day' => 100,
        'available' => 0,
        'car_type_id' => 31
    ];
    $carService->add_car($unavailableCar);
} catch (Exception $e) {
    echo "Error! : " . $e->getMessage();
}
echo "</pre>";

echo "<h3>Cars with brand: Mazda</h3><pre>";
try {
    $mazda = $carService->get_by_brand('Mazda');
    print_r($mazda);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
echo "</pre>";


// CarTypeService

echo "<h2>TEST: CarTypeService</h2>";
echo "<h3>Adding new car type!</h3><pre>";

// adding new Car Type
try {
    $newType = ['name' => 'SuperSUV'];
    $added = $carTypeService->add_car_type($newType);
    print_r($added);
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
    $added = null;
} echo "</pre>";

// Update Car Type
try {
    $carType = $carTypeService->get_by_name('SuperSUV');
    $carType['name'] = 'HoceSamoMERCEDES';
    $updated = $carTypeService->update_car_type($carType['id'],$carType);
    print_r($updated);
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}



// get all Car Types
echo "<h3>All Car Types: </h3><pre>";
print_r($carTypeService->get_all());
echo "</pre>";

// get by name
echo "<h3>Get By Name: </h3><pre>";
print_r($carTypeService->get_by_name('Electric'));
echo "</pre>";


// LocationService 

echo "<h3>Adding new Location:</h3><pre>";




try {
    $newLocation = [
        'name' => 'Tuzla',
        'address' => 'Zmaja od Bosne bb'
    ];
    $added = $locationService->add_location($newLocation);
    print_r($added);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    $added = null;
}
echo "</pre>";


// ReservationService

echo "<h2>TEST: ReservationService</h2>";

// Adding Reservations
echo "<h3>ADD Reservation:</h3><pre>";
try {
    $reservation = [
        'user_id' => 1,
        'car_id' => 2,
        'pickup_date' => '2025-05-10',
        'return_date' => '2025-05-15',
        'pickup_location_id' => 3,
        'return_location_id' => 4,
        'status' => 'active'
    ];

    $added = $reservationService->add_reservation($reservation);
    print_r($added);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    $added = null;
}
echo "</pre>";

// 2. Fetch all reservations
echo "<h3>Users Reservation:</h3><pre>";
print_r($reservationService->get_by_user_id(1));
echo "</pre>";

// Cancel Reservation
if ($added) {
    echo "<h3>Cancelling Reservation:</h3><pre>";
    $reservationService->cancel_reservation($added['id']);
    echo "Reservation ID " . $added['id'] . " cancelled.";
    echo "</pre>";
}


// UserService

// 1. Add new user
echo "<h3>Adding user:</h3><pre>";
try {
    $newUser = [
        'full_name' => 'Hasky',
        'email' => 'hasky@etf.ba',
        'phone_number' => '061-999-999',
        'address' => 'Zenica',
        'password_hash' => password_hash('test1234', PASSWORD_DEFAULT)
    ];

    $added = $userService->add_user($newUser);
    print_r($added);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    $added = null;
}
echo "</pre>";

// 2. Display all users
echo "<h3>All users:</h3><pre>";
print_r($userService->get_all());
echo "</pre>";

// 3. Update user (if added)
if ($added) {
    echo "<h3>Updating user:</h3><pre>";
    try {
        $added['full_name'] = 'Hasssky';
        $updated = $userService->update_user($added['id'], $added);
        print_r($updated);
    } catch (Exception $e) {
        echo "Error during update: " . $e->getMessage();
    }
    echo "</pre>";
}
