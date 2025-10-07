<?php 
include('db_connection.php');

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);   
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check admin from DB
    $sql = "SELECT * FROM admin WHERE username='$username' AND password=MD5('$password')";
    $result = mysqli_query($conn, $sql);

    // Debug agar query fail ho
    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
        $_SESSION['admin'] = $admin['username']; // session set
        header("Location: dashboard.php"); // redirect to dashboard
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<style>
body {font-family: Arial,sans-serif; background:linear-gradient(135deg,#74ebd5,#ACB6E5); height:100vh; display:flex; justify-content:center; align-items:center;}
.login-box {background:white; padding:30px; border-radius:15px; box-shadow:0 4px 20px rgba(0,0,0,0.2); width:350px; text-align:center;}
.login-box h2 {margin-bottom:20px; color:#333;}
.login-box input {width:100%; padding:12px; margin:10px 0; border-radius:8px; border:1px solid #ccc;}
.login-box button {width:100%; padding:12px; background:linear-gradient(90deg,#6a11cb,#2575fc); border:none; border-radius:8px; color:white; font-size:16px; cursor:pointer;}
.login-box button:hover {background:linear-gradient(90deg,#2575fc,#6a11cb);}
.error {color:red; margin-top:15px; font-size:14px;}
</style>
</head>
<body>
<div class="login-box">
<h2>Admin Login</h2>
<form method="post">
    <input type="text" name="username" placeholder=" Username" required>
    <input type="password" name="password" placeholder=" Password" required>
    <button type="submit">Login</button>
</form>
<?php if(!empty($error)) echo "<p class='error'>$error</p>"; ?>
</div>
</body>
</html>
