<?php

/*
http://localhost/Web-Programming/Week2/Lab-Tasks/test.php?method=POST&name=Haris&surname=Susic
http://localhost/Web-Programming/Week2/Lab-Tasks/test.php?method=GET
http://localhost/Web-Programming/Week2/Lab-Tasks/test.php?method=UPDATE&name=Semha&surname=Majser
http://localhost/Web-Programming/Week2/Lab-Tasks/test.php?method=DELETE



*/

session_start();

if (!isset($_SESSION["userData"])) {
    $_SESSION["userData"] = [];
}

$method = isset($_REQUEST["method"]) ? strtoupper($_REQUEST["method"]) : null;
$name = isset($_REQUEST["name"]) ? $_REQUEST["name"] : null;
$surname = isset($_REQUEST["surname"]) ? $_REQUEST["surname"] : null;

$response = [];

switch ($method) {
    case "POST":
        if (isset($name) && !is_null($name) && isset($surname) && !is_null($surname)) {
            $_SESSION["userData"]["name"] = $name;
            $_SESSION["userData"]["surname"] = $surname;
            $response = $_SESSION["userData"];
        } else {
            $response["error"] = "Something is missing, pls check it out!";
        }
        break;

    case "UPDATE":
        if (isset($_SESSION["userData"]["name"]) && isset($_SESSION["userData"]["surname"])) {
            if (isset($name)) $_SESSION["userData"]["name"] = $name;
            if (isset($surname)) $_SESSION["userData"]["surname"] = $surname;
            $response = $_SESSION["userData"];
        } else {
            $response["error"] = "No existing user is here to update..";
        }
        break;

    case "DELETE":
        $_SESSION["userData"] = [];
        $response["message"] = "User data deleted.";
        break;

    case "GET":
        if (!empty($_SESSION["userData"])) {
            $response = $_SESSION["userData"];
        } else {
            $response["message"] = "No user data found.";
        }
        break;

    default:
        $response["error"] = "Default here, you got error..";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
