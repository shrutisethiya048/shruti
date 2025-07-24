<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP Calculator</title>
    <style>
        body {
            font-family: Arial;
            background-color: pink;
            padding: 30px;
        }
        form {
            background: lightblue;
            padding: 20px;
            width: 300px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="number"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
        h2 {
            color: black;
        }
    </style>
</head>
<body>

<h2>PHP Calculator</h2>

<form method="post">
    <label>Enter First Number:</label><br>
    <input type="number" name="num1" required><br><br>

    <label>Enter Second Number:</label><br>
    <input type="number" name="num2" required><br><br>

    <label>Select Operation:</label><br><br>
    <input type="submit" name="operation" value="add">
    <input type="submit" name="operation" value="sub">
    <input type="submit" name="operation" value="mul">
    <input type="submit" name="operation" value="div">
</form>

<?php
if (isset($_POST['operation'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $op = $_POST['operation'];
    $result = "";

    switch ($op) {
        case "add":
            $result = $num1 + $num2;
            echo "<h3>Result: $num1 + $num2 = $result</h3>";
            break;
        case "sub":
            $result = $num1 - $num2;
            echo "<h3>Result: $num1 - $num2 = $result</h3>";
            break;
        case "mul":
            $result = $num1 * $num2;
            echo "<h3>Result: $num1 * $num2 = $result</h3>";
            break;
        case "div":
            if ($num2 == 0) {
                echo "<h3>Cannot divide by 0</h3>";
            } else {
                $result = $num1 / $num2;
                echo "<h3>Result: $num1 / $num2 = $result</h3>";
            }
            break;
        default:
            echo "<h3>Please click a valid operation.</h3>";
    }
}
?>

</body>
</html>
