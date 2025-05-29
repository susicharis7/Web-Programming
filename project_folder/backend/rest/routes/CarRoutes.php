<?php
require_once __DIR__ . '/../services/CarService.php';

/**
 * @OA\Get(
 *     path="/cars",
 *     tags={"cars"},
 *     summary="Get all cars",
 *      security={{"ApiKey": {}}},
 *     @OA\Response(response=200, description="Array of all cars")
 * )
 */
Flight::route('GET /cars', function () {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::car_service()->get_all());
});

/**
 * @OA\Get(
 *     path="/cars/{id}",
 *     tags={"cars"},
 *     summary="Get car by ID",
 *     security={{"ApiKey": {}}},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Car by ID")
 * )
 */
Flight::route('GET /cars/@id', function ($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::car_service()->get_by_id($id));
});

/**
 * @OA\Get(
 *     path="/cars/only-available",
 *     tags={"cars"},
 *     summary="Get all available cars",
 *     security={{"ApiKey": {}}},
 *     @OA\Response(response=200, description="Available cars")
 * )
 */
Flight::route('GET /cars/only-available', function () {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    $cars = Flight::car_service()->get_available();


    error_log("cars from service: " . var_export($cars, true));
    Flight::json(is_array($cars) ? $cars : []);
});




/**
 * @OA\Post(
 *     path="/cars",
 *     tags={"cars"},
 *     summary="Add a new car",
 *     security={{"ApiKey": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"brand", "model", "price_per_day", "car_type_id"},
 *             @OA\Property(property="brand", type="string", example="Mazda"),
 *             @OA\Property(property="model", type="string", example="CX-5"),
 *             @OA\Property(property="year",type="integer",example=2024),
 *             @OA\Property(property="price_per_day", type="number", format="float", example=85.5),
 *             @OA\Property(property="available", type="boolean", example=true),
 *             @OA\Property(property="car_type_id", type="integer", example=1)
 *         )
 *     ),
 *     @OA\Response(response=200, description="Car added")
 * )
 */
Flight::route('POST /cars', function () {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    try {
        Flight::json(Flight::car_service()->add_car($data));
    } catch (Exception $e) {
        Flight::halt(400, json_encode(["error" => $e->getMessage()]));
    }
});

/**
 * @OA\Put(
 *     path="/cars/{id}",
 *     tags={"cars"},
 *     summary="Update car by ID",
 *     security={{"ApiKey": {}}},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="brand", type="string", example="Audi"),
 *             @OA\Property(property="model", type="string", example="A4"),
 *             @OA\Property(property="price_per_day", type="number", example=90),
 *             @OA\Property(property="available", type="boolean", example=false),
 *             @OA\Property(property="car_type_id", type="integer", example=2)
 *         )
 *     ),
 *     @OA\Response(response=200, description="Car updated")
 * )
 */
Flight::route('PUT /cars/@id', function ($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    try {
        Flight::json(Flight::car_service()->update_car($id, $data));
    } catch (Exception $e) {
        Flight::halt(400, json_encode(["error" => $e->getMessage()]));
    }
});

/**
 * @OA\Delete(
 *     path="/cars/{id}",
 *     tags={"cars"},
 *     summary="Delete a car by ID",
 *     security={{"ApiKey": {}}},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Car deleted")
 * )
 */
Flight::route('DELETE /cars/@id', function ($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::car_service()->delete($id);
    Flight::json(["message" => "Car deleted"]);
});
