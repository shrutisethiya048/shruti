<?php

include('db_connection.php'); // database connection include

// Session check
if (!isset($_SESSION['admin'])) {
    header("Location: authentication-login.php");
    exit();
}

// Fetch admin details
$username = $_SESSION['admin'];
$sql = "SELECT * FROM admin WHERE username='$username' LIMIT 1";
$result = mysqli_query($conn, $sql);
$admin = mysqli_fetch_assoc($result);

// Update profile
if (isset($_POST['update'])) {
    $new_username = mysqli_real_escape_string($conn, $_POST['username']);
    $new_password = mysqli_real_escape_string($conn, $_POST['password']);

    // md5 password
    $hashed_password = md5($new_password);

    $update_sql = "UPDATE admin SET username='$new_username', password='$hashed_password' WHERE username='$username'";
    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['admin'] = $new_username; // session update
        header("Location: dashboard.php?update=success");
        exit();
    } else {
        echo "<script>alert('Profile update failed!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Profile</title>
<style>
body {font-family: Arial, sans-serif; background:#f4f6f9; padding:50px;}
form {background:white; padding:30px; border-radius:12px; max-width:400px; margin:auto; box-shadow:0 4px 20px rgba(0,0,0,0.1);}
input {width:100%; padding:12px; margin:10px 0; border-radius:8px; border:1px solid #ccc;}
button {width:100%; padding:12px; border:none; border-radius:8px; background:#2563eb; color:white; font-size:16px; cursor:pointer;}
button:hover {background:#3b82f6;}
h2 {text-align:center; margin-bottom:20px;}
</style>
</head>
<body>

<h2>Admin Profile</h2>
<form method="post">
    <input type="text" name="username" value="<?= htmlspecialchars($admin['username']); ?>" required>
    <input type="password" name="password" placeholder="Enter new password" required>
    <button type="submit" name="update">Update Profile</button>
</form>

</body>
</html>
