<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Ticket</title>
</head>
<body>

<h2>Create Ticket</h2>

<form action="save_ticket.php" method="POST">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Assign To:</label><br>
    <input type="text" name="assigned_to" required><br><br>

    <button type="submit">Submit</button>
</form>

</body>
</html>