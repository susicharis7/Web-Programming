<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        echo "Hello, $name!";
    }

    /*
        prva linija, provjeravamo da li nam je forma poslata
        ako jeste, uzimamo vrijednost iz fielda "name"
        ispisujemo taj field
    */
?>