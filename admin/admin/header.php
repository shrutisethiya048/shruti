<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Beauty Shop</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <!-- 1. jQuery Library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- 2. DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <!-- 3. DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <!-- Initialize DataTable -->
  <script>
    $(document).ready(function() {
      $('#mytable ').DataTable();
    });
  </script>
</head>
<body>

<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Beauty Shop</a>
  <div>
    <a href="shop.php" class="btn btn-outline-success mr-2">Shop</a>
    <a href="cart.php" class="btn btn-outline-primary mr-2">Cart</a>
    <a href="checkout.php" class="btn btn-outline-primary mr-2">Checkout</a>
    <a href="place_order.php" class="btn btn-warning mr-2">Place Order</a>
    <a href="contact.php" class="btn btn-info ml-2">Contact</a>
    <a href="registration.php" class="btn btn-outline-secondary mr-2">Registration</a>
    <a href="login.php" class="btn btn-outline-dark">Login</a>
  </div>
</nav>     