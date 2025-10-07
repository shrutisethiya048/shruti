<?php
// Database Connection
$conn = mysqli_connect("localhost", "root", "", "admin_panel");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all products
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

// Calculate total items in cart
$total_items = 0;
if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $item){
        $total_items += $item['quantity'] ?? 1;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Beauty Store</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<style>
.product-card {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
    text-align: center;
}
.product-img {
    width: 100%;
    max-width: 250px;
    height: 250px;
    object-fit: cover;
    margin: 0 auto 10px auto;
    display: block;
}
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Beauty Shop</a>
  <div>
    <a href="shop.php" class="btn btn-outline-success mr-2">Shop</a>
    <a href="cart.php" class="btn btn-outline-primary mr-2">
      Cart (<?php echo $total_items; ?>)
    </a>
    <a href="registration.php" class="btn btn-outline-secondary mr-2">Registration</a>
    <a href="login.php" class="btn btn-outline-dark">Login</a>
	<a href="contact.php" class="btn btn-info ml-2">Contact</a>
  </div>
</nav>

<div class="container mt-4">
  <h2 class="mb-4 text-center">🛍 Products</h2>
  <div class="row">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="col-md-4">
        <div class="product-card">
          <img src="img/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" class="product-img">
          <h5><?php echo $row['name']; ?></h5>
          <p>₹<?php echo $row['price']; ?></p>
          
          <!-- Add to Cart Form -->
          <form method="post" action="cart.php?action=add&id=<?php echo $row['id']; ?>">
              <input type="hidden" name="hidden_name" value="<?php echo $row['name']; ?>">
              <input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>">
              <input type="hidden" name="hidden_image" value="<?php echo $row['image']; ?>">
              <input type="hidden" name="quantity" value="1">
              <input type="submit" name="add_to_cart" class="btn btn-primary btn-sm" value="Add to Cart">
          </form>

        </div>
      </div>
    <?php } ?>
  </div>
</div>

</body> 
</html>    