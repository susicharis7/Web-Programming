<?php

// 1. Autoload i config
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/rest/config.php';
require_once __DIR__ . '/data/roles.php';
require_once __DIR__ . '/middleware/AuthMiddleware.php';

// 2. DAO
require_once __DIR__ . '/rest/dao/AuthDao.php';

// 3. Services
require_once __DIR__ . '/rest/services/AuthService.php';
require_once __DIR__ . '/rest/services/CarService.php';
require_once __DIR__ . '/rest/services/CarTypeService.php';
require_once __DIR__ . '/rest/services/LocationService.php';
require_once __DIR__ . '/rest/services/ReservationService.php';
require_once __DIR__ . '/rest/services/UserService.php';

// 4. Register middleware and services
Flight::register('auth_service', 'AuthService');
Flight::register('auth_middleware', 'AuthMiddleware');
Flight::register('car_service', 'CarService');
Flight::register('car_type_service', 'CarTypeService');
Flight::register('location_service', 'LocationService');
Flight::register('reservation_service', 'ReservationService');
Flight::register('user_service', 'UserService');

// 5. Global middleware (token verification)
Flight::route('/*', function() {
    $url = Flight::request()->url;
    if (
        strpos($url, '/auth/login') === 0 ||
        strpos($url, '/auth/register') === 0 ||
        strpos($url, '/docs') === 0
    ) {
        return true;
    }

    try {
        $token = Flight::request()->getHeader("Authentication");
        if (Flight::auth_middleware()->verifyToken($token)) return TRUE;
    } catch (\Exception $e) {
        Flight::halt(401, $e->getMessage());
    }
});

// 6. Routes
require_once __DIR__ . '/rest/routes/AuthRoutes.php';
require_once __DIR__ . '/rest/routes/CarRoutes.php';
require_once __DIR__ . '/rest/routes/CarTypeRoutes.php';
require_once __DIR__ . '/rest/routes/LocationRoutes.php';
require_once __DIR__ . '/rest/routes/ReservationRoutes.php';
require_once __DIR__ . '/rest/routes/UserRoutes.php';


Flight::start();
