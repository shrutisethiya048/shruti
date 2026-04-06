<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$conn = mysqli_connect("localhost", "root", "", "admin_panel");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>