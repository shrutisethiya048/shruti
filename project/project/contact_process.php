<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "your_database_name"); // Replace with your DB name
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if(mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "Your message has been sent successfully!";
    } else {
        $_SESSION['error'] = "Error: ".mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: contact.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request!";
    header("Location: contact.php");
    exit();
}
