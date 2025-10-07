<?php
$host = "localhost";   // XAMPP default
$user = "root";        // default user
$pass = "";            // default password (blank in XAMPP)
$dbname = "shop";      // tumhara database name 

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Database Connected Successfully"; // 
?>
