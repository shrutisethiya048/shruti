<?php
$conn = mysqli_connect("localhost", "root", "", "admin_panel");; // database name corrected

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
