<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $nameForm = $_POST["nameForm"];
        $emailForm = $_POST["emailForm"];
        $numberForm = $_POST["numberForm"];

        if(empty($nameForm)) {
            echo "Unesi pravo ime!"; 
        } else if(!str_contains($emailForm,"@")) {
            echo "Gdje ti je '@' RECI MI MOLIM TE!"; 
        } else if(is_numeric($numberForm) && $numberForm > 18) {
            echo "Numeric je i imas vise od 18, good job!";
        } else {
            echo "MA NISTA NIJE DOBRO !!!";
        }

        

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form Handling Treci Task</title>
</head>
<body>
    <form method="POST" action="">
        <input type="name" name="nameForm" placeholder="Enter your name:"> <br> <br>
        <input type="email" name="emailForm" placeholder="Enter your email:"> <br> <br>
        <input type="number" name="numberForm" placeholder="Enter your age:"> <br> <br>
        <button type="submit">SUBMIT</button>
        
    </form>
</body>
</html>

<?php 
    if (!empty($nameForm) && str_contains($emailForm, "@") && is_numeric($numberForm) && $numberForm > 18) {
        echo "<br><br>Validacija: <br>";
        echo "Ime: $nameForm <br>";
        echo "Email: $emailForm <br>";
        echo "Godine: $numberForm <br>";
    }
    
?>

