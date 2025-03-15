<?php


    function greet($name) {
        return "Hello, $name!";
    }

    echo greet("Sumea");

    /* 
     Built-in Functions:
        - strlen() : returns string length
        - count() : counts elements in array
        - date() : returns current date/time 
    */

    $name = "Haris";
    echo "<br>";
    echo "Letters in my name: " . strlen($name);

    $names = ["Harke","Tarci","Boki"];
    echo "<br>";
    echo "Names in array (counting them): " . count($names) . "<br>";
    

    foreach($names as $n) {
        echo "Names: " . $n . "<br>";
    }

    $timestamp = time();

    echo "Time and date right now: " . date($timestamp);




?>