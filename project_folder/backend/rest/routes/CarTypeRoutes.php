<?php
require_once __DIR__ . '/../services/CarTypeService.php';

/**
 * @OA\Get(
 *     path="/car-types",
 *     tags={"car_types"},
 *     summary="Get all car types",
 *     @OA\Response(response=200, description="Array of car types")
 * )
 */
Flight::route('GET /car-types', function () {
    Flight::json(Flight::car_type_service()->get_all());
});

/**
 * @OA\Get(
 *     path="/car-types/{id}",
 *     tags={"car_types"},
 *     summary="Get car type by ID",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Car type found")
 * )
 */
Flight::route('GET /car-types/@id', function ($id) {
    Flight::json(Flight::car_type_service()->get_by_id($id));
});

/**
 * @OA\Post(
 *     path="/car-types",
 *     tags={"car_types"},
 *     summary="Add a new car type",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name"},
 *             @OA\Property(property="name", type="string", example="SUV")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Car type added")
 * )
 */
Flight::route('POST /car-types', function () {
    $data = Flight::request()->data->getData();
    try {
        Flight::json(Flight::car_type_service()->add_car_type($data));
    } catch (Exception $e) {
        Flight::halt(400, json_encode(["error" => $e->getMessage()]));
    }
});

/**
 * @OA\Put(
 *     path="/car-types/{id}",
 *     tags={"car_types"},
 *     summary="Update car type",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Convertible")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Car type updated")
 * )
 */
Flight::route('PUT /car-types/@id', function ($id) {
    $data = Flight::request()->data->getData();
    try {
        Flight::json(Flight::car_type_service()->update_car_type($id, $data));
    } catch (Exception $e) {
        Flight::halt(400, json_encode(["error" => $e->getMessage()]));
    }
});

/**
 * @OA\Delete(
 *     path="/car-types/{id}",
 *     tags={"car_types"},
 *     summary="Delete car type",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Car type deleted")
 * )
 */
Flight::route('DELETE /car-types/@id', function ($id) {
    Flight::car_type_service()->delete($id);
    Flight::json(["message" => "Car type deleted"]);
});
