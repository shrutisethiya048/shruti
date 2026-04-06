<?php
$conn = mysqli_connect("localhost", "root", "", "your_database_name");; // database name corrected

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
