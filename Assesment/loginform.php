<?php
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stored_email = "shruti@gmail.com";
  $stored_password = "12345";

  if ($email === $stored_email && $password === $stored_password) {
    header("Location: e_note_book.php");
    exit();
  } else {
    $error = "Invalid Email or Password!";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <style>
    body {
      background-color: #f2f2f2; 
      font-family: Arial, sans-serif;
    }
    .login-box {
      width: 350px;
      margin: 100px auto;
      background: #b3e5fc;  
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }
    h2 {
      text-align: center;
      margin-bottom: 25px;
    }
    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }
    button {
      width: 100%;
      background-color: #006400; 
      color: white;
      border: none;
      padding: 10px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
    }
    .error, .success {
      text-align: center;
      margin-top: 15px;
      font-weight: bold;
    }
    .error {
      color: red;
    }
    .success {
      color: green;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Login Form</h2>
    <form method="post">
      <label for="email">Email:</label>
      <input type="text" name="email" id="email" required>

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>
      <button type="submit" name="login">Login</button>
	  <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    </form>
  </div>
  </body>
</html>
