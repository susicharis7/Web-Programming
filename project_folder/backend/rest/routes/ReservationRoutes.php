<?php
require_once __DIR__ . '/../services/ReservationService.php';

/**
 * @OA\Get(
 *     path="/reservations",
 *     tags={"reservations"},
 *     summary="Get all reservations",
 * security={{"ApiKey": {}}},
 *     @OA\Response(response=200, description="Array of reservations")
 * )
 */
Flight::route('GET /reservations', function () {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::reservation_service()->get_all());
});

/**
 * @OA\Get(
 *     path="/reservations/{id}",
 *     tags={"reservations"},
 *     summary="Get reservation by ID",
 * security={{"ApiKey": {}}},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Reservation by ID")
 * )
 */
Flight::route('GET /reservations/@id', function ($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::reservation_service()->get_by_id($id));
});

/**
 * @OA\Get(
 *     path="/reservations/user/{user_id}",
 *     tags={"reservations"},
 *     summary="Get reservations by user ID",
 * security={{"ApiKey": {}}},
 *     @OA\Parameter(name="user_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Reservations for a user")
 * )
 */
Flight::route('GET /reservations/user/@user_id', function ($user_id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::reservation_service()->get_by_user_id($user_id));
});

/**
 * @OA\Get(
 *     path="/reservations/active",
 *     tags={"reservations"},
 *     summary="Get all active reservations",
 * security={{"ApiKey": {}}},
 *     @OA\Response(response=200, description="Active reservations")
 * )
 */
Flight::route('GET /reservations/active', function () {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::reservation_service()->get_all(['status' => 'active']));
});

/**
 * @OA\Post(
 *     path="/reservations",
 *     tags={"reservations"},
 *     summary="Create a reservation",
 * security={{"ApiKey": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "car_id", "pickup_date", "return_date", "pickup_location_id", "return_location_id", "status"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="car_id", type="integer", example=2),
 *             @OA\Property(property="pickup_date", type="string", format="date", example="2025-05-06"),
 *             @OA\Property(property="return_date", type="string", format="date", example="2025-05-10"),
 *             @OA\Property(property="pickup_location_id", type="integer", example=1),
 *             @OA\Property(property="return_location_id", type="integer", example=2),
 *             @OA\Property(property="status", type="string", enum={"active", "cancelled"}, example="active")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Reservation created")
 * )
 */
Flight::route('POST /reservations', function () {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    $data = Flight::request()->data->getData();
    try {
        Flight::json(Flight::reservation_service()->add_reservation($data));
    } catch (Exception $e) {
        Flight::halt(400, json_encode(["error" => $e->getMessage()]));
    }
});

/**
 * @OA\Put(
 *     path="/reservations/cancel/{id}",
 *     tags={"reservations"},
 *     summary="Cancel a reservation",
 * security={{"ApiKey": {}}},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Reservation cancelled")
 * )
 */
Flight::route('PUT /reservations/cancel/@id', function ($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    try {
        Flight::reservation_service()->cancel_reservation($id);
        Flight::json(["message" => "Reservation cancelled"]);
    } catch (Exception $e) {
        Flight::halt(400, json_encode(["error" => $e->getMessage()]));
    }
});
