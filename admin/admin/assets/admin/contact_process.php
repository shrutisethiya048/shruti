<?php
session_start();  //
include("header.php");
include_once("model.php");

// Database connection
$conn = new mysqli("localhost", "root", "", "admin_panel");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert into database (contacts table)
    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Thank you! Your message has been sent successfully.";
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again!";
    }
}

header("Location: contact");  // redirect back to form
exit;
?>
