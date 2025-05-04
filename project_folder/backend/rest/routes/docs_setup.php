<?php
/**
* @OA\Info(
*     title="API",
*     description="Car Rental API",
*     version="1.0",
*     @OA\Contact(
*         email="susicharis99@gmail.com",
*         name="Web-Programming"
*     )
* )
*/
/**
* @OA\Server(
*     url= "http://localhost/Web-Programming/project_folder/backend",
*     description="API server"
* )
*/
/**
* @OA\SecurityScheme(
*     securityScheme="ApiKey",
*     type="apiKey",
*     in="header",
*     name="Authentication"
* )
*/
class SwaggerSetup {}