<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "your_database_name");

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
