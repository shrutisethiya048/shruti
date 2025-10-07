<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "your_database_name");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email already registered. Please login.";
    } else {
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "Registration successful! You can now login.";
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Beauty Shop</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background: #ffffff; /* pure white background */
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }
    .container {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .register-form {
      width: 100%;
      max-width: 450px;
      padding: 30px;
    }
    .register-form h3 {
      text-align: center;
      margin-bottom: 25px;
      font-weight: bold;
      color: #d63384;
    }
    .form-control {
      border-radius: 30px;
      padding: 12px 20px;
    }
    .btn-custom {
      background: linear-gradient(135deg, #ff758c, #ff7eb3);
      border: none;
      border-radius: 30px;
      padding: 12px;
      color: white;
      font-weight: bold;
      width: 100%;
      transition: 0.3s;
    }
    .btn-custom:hover {
      background: linear-gradient(135deg, #ff5f7e, #ff4a91);
      transform: scale(1.05);
    }
    a {
      color: #d63384;
      font-weight: 500;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="register-form">
      <h3>🌸 Create Account</h3>

      <?php if ($error != "") { echo "<div class='alert alert-danger'>$error</div>"; } ?>
      <?php if (isset($_SESSION['success'])) { echo "<div class='alert alert-success'>".$_SESSION['success']."</div>"; unset($_SESSION['success']); } ?>

      <form method="POST" action="">
        <div class="form-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Full Name" required>
        </div>

        <div class="form-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email Address" required>
        </div>

        <div class="form-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-custom">Register</button>
      </form>

      <p class="text-center mt-3">
        Already have an account? <a href="login.php">Login</a>
      </p>
    </div>
  </div>

</body>
</html>
