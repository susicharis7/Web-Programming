<?php

require_once __DIR__ . '/vendor/autoload.php';

Flight::register('car_service', 'CarService');
Flight::register('car_type_service', 'CarTypeService');
Flight::register('location_service', 'LocationService');
Flight::register('reservation_service', 'ReservationService');
Flight::register('user_service', 'UserService');

require_once __DIR__ . '/rest/routes/CarRoutes.php';
require_once __DIR__ . '/rest/routes/CarTypeRoutes.php';
require_once __DIR__ . '/rest/routes/LocationRoutes.php'; 
require_once __DIR__ . '/rest/routes/ReservationRoutes.php';
require_once __DIR__ . '/rest/routes/UserRoutes.php'; 

// Pokreni FlightPHP
Flight::start();
