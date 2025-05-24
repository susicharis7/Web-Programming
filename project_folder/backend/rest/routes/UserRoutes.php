<?php
require_once __DIR__ . '/../services/UserService.php';

/**
 * @OA\Get(
 *     path="/users",
 *     tags={"users"},
 *     summary="Get all users",
 * security={{"ApiKey": {}}},
 *     @OA\Response(response=200, description="Array of users")
 * )
 */
Flight::route('GET /users', function () {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::user_service()->get_all());
});

/**
 * @OA\Get(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Get user by ID",
 * security={{"ApiKey": {}}},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="User by ID")
 * )
 */
Flight::route('GET /users/@id', function ($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::user_service()->get_by_id($id));
});

/**
 * @OA\Get(
 *     path="/users/email/{email}",
 *     tags={"users"},
 *     summary="Get user by email",
 * security={{"ApiKey": {}}},
 *     @OA\Parameter(name="email", in="path", required=true, @OA\Schema(type="string")),
 *     @OA\Response(response=200, description="User by email")
 * )
 */
Flight::route('GET /users/email/@email', function ($email) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::user_service()->get_user_by_email($email));
});

/**
 * @OA\Post(
 *     path="/users",
 *     tags={"users"},
 *     summary="Register new user",
 * security={{"ApiKey": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"full_name", "email", "password", "phone_number", "address"},
 *             @OA\Property(property="full_name", type="string", example="Tarik Jasenkovic"),
 *             @OA\Property(property="email", type="string", format="email", example="tarik@example.com"),
 *             @OA\Property(property="password", type="string", example="password123"),
 *             @OA\Property(property="phone_number", type="string", example="061446917"),
 *             @OA\Property(property="address", type="string", example="Zmaja od Bosne 12, Sarajevo")
 *         )
 *     ),
 *     @OA\Response(response=200, description="User registered")
 * )
 */
Flight::route('POST /users', function () {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    $data = Flight::request()->data->getData();
    $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
    unset($data['password']);

    try {
        Flight::json(Flight::user_service()->add_user($data));
    } catch (Exception $e) {
        Flight::halt(400, json_encode(["error" => $e->getMessage()]));
    }
});

/**
 * @OA\Put(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Update user",
 * security={{"ApiKey": {}}},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="full_name", type="string", example="Tarik Jasenko"),
 *             @OA\Property(property="email", type="string", format="email", example="new@example.com"),
 *             @OA\Property(property="phone_number", type="string", example="062334455"),
 *             @OA\Property(property="address", type="string", example="Miljacka bb, Sarajevo")
 *         )
 *     ),
 *     @OA\Response(response=200, description="User updated")
 * )
 */
Flight::route('PUT /users/@id', function ($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    $data = Flight::request()->data->getData();
    try {
        Flight::json(Flight::user_service()->update_user($id, $data));
    } catch (Exception $e) {
        Flight::halt(400, json_encode(["error" => $e->getMessage()]));
    }
});

/**
 * @OA\Post(
 *     path="/users/login",
 *     tags={"users"},
 *     summary="Login with email and password",
 * security={{"ApiKey": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email", "password"},
 *             @OA\Property(property="email", type="string", example="tarik@example.com"),
 *             @OA\Property(property="password", type="string", example="password123")
 *         )
 *     ),
 *     @OA\Response(response=200, description="User authenticated"),
 *     @OA\Response(response=401, description="Invalid credentials")
 * )
 */
Flight::route('POST /users/login', function () {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    $data = Flight::request()->data->getData();
    try {
        Flight::json(Flight::user_service()->login($data['email'], $data['password']));
    } catch (Exception $e) {
        Flight::halt(401, json_encode(["error" => $e->getMessage()]));
    }
});
