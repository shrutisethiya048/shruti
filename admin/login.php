<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include model for DB connection
include_once("model.php");
$obj = new model(); // Make sure your model.php has working DB connection

$message = '';

// Form submission
if(isset($_POST['email']) && isset($_POST['password'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Fetch user from DB
    $where = ["email" => $email];
    $result = $obj->select_where("users", $where);

    if($result && $result->num_rows > 0){
        $user = $result->fetch_object();

        // Check plain text password
        if($user->password === $password){
            // Check if user is blocked
            if($user->status === "Block"){
                $message = "⚠️ Your account is blocked. Contact admin.";
            } else {
                // Set session
                $_SESSION['u_id']     = $user->id;
                $_SESSION['u_name']   = $user->name;
                $_SESSION['u_email']  = $user->email;
                $_SESSION['u_status'] = $user->status;

                // Redirect
                echo "<script>alert('Login Successful'); window.location='index.php';</script>";
                exit;
            }
        } else {
            $message = "❌ Wrong email or password!";
        }
    } else {
        $message = "❌ User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login - Beauty Shop</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
body {
    background: #f4f4f4;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Segoe UI', sans-serif;
}
.login-card {
    background: #fff;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0px 8px 20px rgba(0,0,0,0.2);
    width: 100%;
    max-width: 400px;
}
.login-card h3 {
    font-weight: bold;
    color: #d63384;
    text-align: center;
    margin-bottom: 20px;
}
.form-control {
    border-radius: 30px;
    padding: 12px 20px;
    margin-bottom: 15px;
}
.btn-custom {
    background: linear-gradient(135deg, #ff758c, #ff7eb3);
    border: none;
    border-radius: 30px;
    padding: 12px;
    color: white;
    font-weight: bold;
    width: 100%;
}
.btn-custom:hover {
    background: linear-gradient(135deg, #ff5f7e, #ff4a91);
    transform: scale(1.05);
}
.alert {
    border-radius: 20px;
    padding: 10px 20px;
    margin-bottom: 15px;
    text-align: center;
}
a {
    color: #d63384;
    font-weight: 500;
}
</style>
</head>
<body>

<div class="login-card">
    <h3>Login</h3>

    <?php if($message !== ''): ?>
        <div class="alert alert-danger"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
        <button type="submit" class="btn btn-custom">Login</button>
    </form>

    <p class="text-center mt-3">
        Don’t have an account? <a href="registration.php">Register Now</a>
    </p>
</div>

</body>
</html>
