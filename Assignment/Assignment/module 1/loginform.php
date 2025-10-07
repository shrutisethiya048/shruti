<html>
<head>
  <title>Login Form</title>
  <style>
    body {
      font-family: Arial;
      background-color: #f0f0f0;
      padding: 40px;
    }
    .form-box {
      background: #cceeff;
      padding: 20px;
      width: 300px;
      margin: auto;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    h2 {
      text-align: center;
    }
    input[type="email"],
    input[type="password"]; {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
    }
    input[type="submit"] {
      width: 100%;
      background-color: #006400;
      color: white;
      padding: 10px;
      border: none;
      cursor: pointer;
    }
    .message {
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<div class="form-box">
  <h2>Login Form</h2>
  <form method="post">
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Password:</label>
    <input type="password" name="password" required>
    <input type="submit" name="login" value="Login">
  </form>

  <div class="message">
  <?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stored_email = "shruti@gmail.com";
    $stored_hashed_password = '$2y$10$JrwIVigk1PdQBdLtnqZ/7uCcmIdgmMf1xlzDh4Qdf/NTn8AOgzLJ6'; // password = 12345

    if ($email == $stored_email && password_verify($password, $stored_hashed_password)) {
        echo "<p>Login successful. Welcome, $email!</p>";
    } else {
        echo "<p>Invalid Email or Password!</p>";
    }
}
?>
