<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
      background: #ffffff;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }
    .login-card {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0px 8px 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
      animation: fadeIn 1s ease-in-out;
    }
    .login-card h3 {
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
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <div class="login-card">
    <h3 class="text-center mb-4"> Login</h3>
    <form action="index.php" method="POST">
      <div class="form-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
      </div>

      <div class="form-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
      </div>

      <button type="submit" class="btn btn-custom btn-block">Login</button>
    </form>
    <p class="text-center mt-3">
      Don’t have an account? <a href="registration.php">Register Now</a>
    </p>
  </div>

</body>
</html>
