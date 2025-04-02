<?php
    $name = "Haris"; // String
    $age = 25; // Integer
    $price = 12.99; // Float
    $isLoggedIn = true; // Boolean
    $colors = ["Red","Blue"]; // Array
    $colorsResult = implode(";", $colors);
    $value = NULL; // No Value

    class User {

    }
    $user = new User();

    

    // Ispis varijabli
    echo "Ime: $name <br>";
    echo "Godine: $age <br>";
    echo "Cijena: $price <br>";
    echo "Ulogovan: " . ($isLoggedIn ? "Da" : "Ne"). "<br>";
    echo "Colors: ".implode(", ", $colors)."<br>";
    echo "Colors Result: $colorsResult <br>";



    // If Else

    $age = 20;
    if($age >= 18) {
        echo "You are an adult!";
    } else {
        echo "You are a minor!";
    }

    // Switch Case

    $day = "Monday";
    switch($day) {
        case "Monday":
            echo "Start of the week!";
            break;
        case "Friday":
            echo "Weekend is near!";
            break;
        default:
            echo "Regular weekday.";
    }
    

    // While loop

    $count = 1;
    while($count <= 5) {
        echo "\n <br> Number: $count <br>";
        $count++;
    }

    // For loop
    $colorsAgain = ["Red","Green","Blue"];
    for($i = 0; $i < count($colorsAgain); $i++) {
        echo "Iteration: ". $colorsAgain[$i]."<br>";
    }

    // Foreach Loop
    $colorsFor = ["Orange","Turquise","Yellow"];
    foreach($colorsFor as $c) {
        echo "Color: $c <br>";
    }

    // Arrays in PHP

    // Indexed Array
    $fruits = ["Apple","Banana","Cherry"];
    echo $fruits[1]."<br>";

    // Associative Array(key-value pair)
    $person = ["name" => "Haris", "age" => 20];
    echo $person["name"] . "<br>" . $person["age"];

    // Multidimensional Arrays

    $students = [["Sumea",20], ["Haris",20]];
    echo $students[1][0]; // Haris


    // Operators 

    // Arithmetic
    echo "<br>";
    $a = 10;
    $b = 5;
    echo $a + $b;

    // Comparison
    var_dump($a == $b);
    echo "<br>";
    var_dump($a > $b);

    // Logical
    if($a > 0 && $b > 0) {
        echo "Positive numbers both!" . "<br>";
    }    

    // Assignment operators
    $a += 5;
    echo "$a after incrementation! <br>";

    // String operators
    $txt1 = "Hello";
    $txt2 = "World";
    echo $txt1 . $txt2;

    

?>