<?php
require_once __DIR__ . '/../services/LocationService.php';

/**
 * @OA\Get(
 *     path="/locations",
 *     tags={"locations"},
 *     summary="Get all locations",
 * security={{"ApiKey": {}}},
 *     @OA\Response(response=200, description="Array of locations")
 * )
 */
Flight::route('GET /locations', function () {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::location_service()->get_all());
});

/**
 * @OA\Get(
 *     path="/locations/{id}",
 *     tags={"locations"},
 *     summary="Get location by ID",
 * security={{"ApiKey": {}}},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Location by ID")
 * )
 */
Flight::route('GET /locations/@id', function ($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::location_service()->get_by_id($id));
});

/**
 * @OA\Post(
 *     path="/locations",
 *     tags={"locations"},
 *     summary="Add a new location",
 * security={{"ApiKey": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "address"},
 *             @OA\Property(property="name", type="string", example="Sarajevo Branch"),
 *             @OA\Property(property="address", type="string", example="Zmaja od Bosne 10")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Location added")
 * )
 */
Flight::route('POST /locations', function () {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    try {
        Flight::json(Flight::location_service()->add_location($data));
    } catch (Exception $e) {
        Flight::halt(400, json_encode(["error" => $e->getMessage()]));
    }
});

/**
 * @OA\Put(
 *     path="/locations/{id}",
 *     tags={"locations"},
 *     summary="Update location",
 * security={{"ApiKey": {}}},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Tuzla Branch"),
 *             @OA\Property(property="address", type="string", example="Kulina Bana 5")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Location updated")
 * )
 */
Flight::route('PUT /locations/@id', function ($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    try {
        Flight::json(Flight::location_service()->update_location($id, $data));
    } catch (Exception $e) {
        Flight::halt(400, json_encode(["error" => $e->getMessage()]));
    }
});

/**
 * @OA\Delete(
 *     path="/locations/{id}",
 *     tags={"locations"},
 *     summary="Delete location",
 * security={{"ApiKey": {}}},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Location deleted")
 * )
 */
Flight::route('DELETE /locations/@id', function ($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::location_service()->delete($id);
    Flight::json(["message" => "Location deleted"]);
});
