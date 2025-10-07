<html>
<head>
    <title>DOB Age Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            text-align: center;
            padding: 50px;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        input[type="date"],
        input[type="submit"] {
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: pink;
            color: white;
            cursor: pointer;
        }

        h2 {
            color: dark gray;
        }

        h3 {
            color: block;
        }
    </style>
</head>
<body>

<h2>Calculate Your Age</h2>

<form method="post">
    Enter your Date of Birth:<br>
    <input type="date" name="dob" required><br>
    <input type="submit" name="calculate" value="Calculate Age">
</form>

<?php
if (isset($_POST['calculate'])) {
    $dob = $_POST['dob'];
    $dobObject = new DateTime($dob);
    $today = new DateTime();
    $age = $dobObject->diff($today);

    echo "<h3>Your Age is: " . $age->y . " Years, " . $age->m . " Months, " . $age->d . " Days</h3>";
}
?>

</body>
</html>
