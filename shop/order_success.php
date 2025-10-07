<?php
session_start();
if(empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit();
}

unset($_SESSION['cart']); // 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Success</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container text-center mt-5">
    <h1 class="text-success">🎉 Thank You!</h1>
    <p>Your order has been placed successfully.</p>
    <a href="index.php" class="btn btn-primary">Back to Home</a>
</div>
</body>
</html>
