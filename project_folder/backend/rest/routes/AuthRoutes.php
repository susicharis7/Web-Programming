<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::group('/auth', function() {

/**
 * @OA\Post(
 *     path="/auth/register",
 *     summary="Register new user.",
 *     tags={"auth"},
 *     @OA\RequestBody(
 *         description="Add new user",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 required={"full_name", "email", "password", "phone_number", "address"},
 *                 @OA\Property(property="full_name", type="string", example="Tarik Jasenko", description="Full name of the user"),
 *                 @OA\Property(property="email", type="string", example="demo@gmail.com", description="User email"),
 *                 @OA\Property(property="password", type="string", example="123456", description="User password (plain, will be hashed)"),
 *                 @OA\Property(property="phone_number", type="string", example="061123456", description="User phone number"),
 *                 @OA\Property(property="address", type="string", example="Zmaja od Bosne 12", description="User address")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=200, description="User registered"),
 *     @OA\Response(response=500, description="Internal error")
 * )
 */


   Flight::route('POST /register', function () {
       $data = Flight::request()->data->getData();
       $response = Flight::auth_service()->register($data);
       if ($response['success']) {
           Flight::json(['message' => 'Registered', 'data' => $response['data']]);
       } else {
           Flight::halt(500, $response['error']);
       }
   });

   /**
    * @OA\Post(
    *     path="/auth/login",
    *     summary="Login",
    *     tags={"auth"},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 required={"email", "password"},
    *                 @OA\Property(property="email", type="string", example="demo@gmail.com"),
    *                 @OA\Property(property="password", type="string", example="123456")
    *             )
    *         )
    *     ),
    *     @OA\Response(response=200, description="Token + user data"),
    *     @OA\Response(response=401, description="Invalid credentials")
    * )
    */
   Flight::route('POST /login', function () {
       $data = Flight::request()->data->getData();
       $response = Flight::auth_service()->login($data);
       if ($response['success']) {
           Flight::json(['message' => 'Login successful', 'data' => $response['data']]);
       } else {
           Flight::halt(401, $response['error']);
       }
   });
});
