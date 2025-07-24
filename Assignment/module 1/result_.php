<!DOCTYPE html>
<html>
<head>
 <title>Marksheet Result</title>
 <style>
    body {
        font-family: Arial;
        background-color: blue;
        padding: 30px;
    }
    form {
        background: orange;
        padding: 20px;
        width: 300px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    input[type="text"], input[type="number"], input[type="submit"], select {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
    }
    h2 {
        color: black;
    }
    .result {
        background: pink;
        margin-top: 20px;
        padding: 15px;
        border-left: 5px solid green;
    }
 </style>
</head>
<body>

<h2>Student Marksheet</h2>

<form method="post" action="">
    <label>Student Name:</label><br>
    <input type="text" name="student_name" required><br><br>

    <label>Hindi Marks:</label><br>
    <input type="number" name="hindi" required min="0" max="100"><br><br>

    <label>English Marks:</label><br>
    <input type="number" name="english" required min="0" max="100"><br><br>

    <label>Java Marks:</label><br>
    <input type="number" name="java" required min="0" max="100"><br><br>

    <label>PHP Marks:</label><br>
    <input type="number" name="php" required min="0" max="100"><br><br>

    <label>Computer Science Marks:</label><br>
    <input type="number" name="computer_science" required min="0" max="100"><br><br>

    <input type="submit" name="submit" value="Show Result">
</form>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['student_name'];
    $hindi = $_POST['hindi'];
    $english = $_POST['english'];
    $java = $_POST['java'];
    $php = $_POST['php'];
    $computer_science = $_POST['computer_science'];

    $total = $hindi + $english + $java + $php + $computer_science;
    $per = ($total * 100) / 500;

    if ($per > 90) {
        $grade = "A+ Grade";
    } elseif ($per > 80) {
        $grade = "A Grade";
    } elseif ($per > 70) {
        $grade = "B+ Grade";
    } elseif ($per > 60) {
        $grade = "B Grade";
    } elseif ($per > 50) {
        $grade = "C+ Grade";
    } elseif ($per > 40) {
        $grade = "C Grade";
    } else {
        $grade = "Fail";
    }

    echo "<div class='result'>";
    echo "<h3>Result for <u>$name</u>:</h3>";
    echo "Total Marks: $total / 500<br>";
    echo "Percentage: " . round($per, 2) . " %<br>";
    echo "Grade: $grade";
    echo "</div>";
}
?>

</body>
</html>
