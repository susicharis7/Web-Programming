<?php
$result = ''; // Prazan rezultat na početku

// Kada korisnik pošalje formu (klikne submit)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number1 = $_POST["number1"];
    $number2 = $_POST["number2"];
    $operation = $_POST["operation"];

    // Provera da su uneti brojevi
    if (is_numeric($number1) && is_numeric($number2)) {
        switch ($operation) {
            case '+':
                $result = $number1 + $number2;
                break;
            case '-':
                $result = $number1 - $number2;
                break;
            case '*':
                $result = $number1 * $number2;
                break;
            case '/':
                if ($number2 != 0) {
                    $result = $number1 / $number2;
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
<html>
<head>
    <title>Simple Calculator</title>
</head>
<body>

<h2>Simple Calculator</h2>

<form method="post" action="">
    Number 1: <input type="text" name="number1" required><br><br>
    Number 2: <input type="text" name="number2" required><br><br>

    Operation:
    <select name="operation" required>
        <option value="+">Addition (+)</option>
        <option value="-">Subtraction (-)</option>
        <option value="*">Multiplication (*)</option>
        <option value="/">Division (/)</option>
    </select><br><br>

    <button type="submit">Calculate</button>
</form>

<?php
// Prikaz rezultata ako postoji
if ($result !== '') {
    echo "<h3>Result: $result</h3>";
}
?>

</body>
</html>
