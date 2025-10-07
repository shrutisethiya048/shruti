<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: authentication-login.php");
    exit();
}

include('db_connection.php');

if (!isset($_GET['id'])) {
    die("User ID not specified.");
}

$user_id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
if (mysqli_num_rows($result) == 0) {
    die("User not found.");
}
$user = mysqli_fetch_assoc($result);

// Handle form submission
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);

    mysqli_query($conn, "UPDATE users SET name='$name', email='$email', mobile='$mobile' WHERE id=$user_id");
    header("Location: users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input { display: block; margin: 10px 0; padding: 8px; width: 300px; }
        button { padding: 8px 15px; }
    </style>
</head>
<body>
    <h2>Edit User</h2>
    <form method="post">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label>Mobile:</label>
        <input type="text" name="mobile" value="<?php echo htmlspecialchars($user['mobile']); ?>" required>

        <button type="submit" name="update">Update User</button>
    </form>
</body>
</html>
