<?php
$result = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstNum = $_POST["firstNum"];
    $secondNum = $_POST["secondNum"];
    $operation = $_POST["operation"];

    if (is_numeric($firstNum) && is_numeric($secondNum)) {
        switch ($operation) {
            case '+':
                $result = $firstNum + $secondNum;
                break;
            case '-':
                $result = $firstNum - $secondNum;
                break;
            case '*':
                $result = $firstNum * $secondNum;
                break;
            case '/':
                if ($secondNum != 0) {
                    $result = $firstNum / $secondNum;
                } else {
                    $result = "Cannot divide by zero!";
                }
                break;
            default:
                $result = "Invalid operation selected!";
        }
    } else {
        $result = "Please enter valid numbers!";
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simple Calc. App</title>
</head>
<body>

    <form method="POST" action="">
        First Number : <input type="text" name="firstNum" placeholder="Enter first Number:"> </br>
        Second Number : <input type="text" name="secondNum" placeholder="Enter second Number:"> </br>

        Selectaj Operation! : 
        <select name="operation" required>
            <option value ="+">Addition</option>
            <option value ="-">Subtraction</option>
            <option value ="*">Multiplication</option>
            <option value="/">Division</option>
        </select> <br>
        <button type="submit">CALCULATE</button>
    </form>
    
</body>
</html>


<?php
    if ($result !== '') {
        echo "<h3>Result: $result</h3>";
    }
?>