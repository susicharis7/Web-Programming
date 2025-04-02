<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $luckyNum = $_POST["luckyNum"];

    
    if (empty($luckyNum) || !is_numeric($luckyNum)) {
        echo "It's empty or it is not numeric!";
    } else if ($luckyNum > 10 || $luckyNum < 1) {
        echo "You are going under/over the limit! Choose between 1-10!";
    } else {
        
        $randomNum = rand(1, 10);

        // 3. Poređenje
        if ($luckyNum == $randomNum) {
            echo "BRAVO BRE! The number was $randomNum.";
        } else if ($luckyNum < $randomNum) {
            echo "Too low! The number was $randomNum.";
        } else {
            echo "Too high! The number was $randomNum.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Guessing Game</title>
</head>
<body>
    <form method="POST" action="">
        Input your lucky number: 
        <input type="number" name="luckyNum" placeholder="Between 1-10: ">
        <button type="submit">SUBMIT</button>
    </form>
</body>
</html>
