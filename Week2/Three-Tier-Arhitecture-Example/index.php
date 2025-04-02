<?php
require 'flight/Flight.php';
require_once 'UserService.php';

// Home ruta
Flight::route('/index.php', function(){
    echo "Hello from FlightPHP! Home page works.";
});

// Users ruta
Flight::route('/index.php/users', function(){
    $users = UserService::getAllUsers(); // Povezuje se sa tvojom "bazom"
    Flight::json($users); // Vraca kao JSON
});

Flight::start();
?>
