<?php
    $filename = "sample.txt";

    if(file_exists($filename)) {
        $content = file_get_contents($filename);

        echo "<h2>You are reading this right now from php: <h2>";
        echo nl2br($content); // found on w3schools -> nl2br adds <br> instead newlines
    } else {
        echo "File doesnt exist!";
    }
?>