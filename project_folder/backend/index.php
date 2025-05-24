<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/rest/config.php';

require_once __DIR__ . '/rest/dao/AuthDao.php';
require_once __DIR__ . '/rest/services/AuthService.php';
Flight::register('auth_service', 'AuthService');

// ✅ Middleware (JWT provjera)
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::route('/*', function () {
    $url = Flight::request()->url;
    if (strpos($url, '/auth/login') === 0 || strpos($url, '/auth/register') === 0 || strpos($url, '/docs') === 0) {
        return true;
    }

    $token = Flight::request()->getHeader("Authentication");
    if (!$token) {
        Flight::halt(401, "Missing authentication header");
    }

    try {
        $decoded = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));
        Flight::set('user', $decoded->user);
        Flight::set('jwt_token', $token);
    } catch (Exception $e) {
        Flight::halt(401, $e->getMessage());
    }
});

require_once __DIR__ . '/rest/routes/AuthRoutes.php';

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
