<?php
// Database Connection
$conn = mysqli_connect("localhost", "root", "", "admin_panel");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch only 3 featured products
$query = "SELECT * FROM products LIMIT 3";
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
<title>Beauty Shop - Home</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<style>
.hero {
    background: url('img/banner.jpg') no-repeat center center/cover;
    height: 400px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-size: 2rem;
    font-weight: bold;
}
.product-card {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
    text-align: center;
}
.product-img {
    width: 100%;
    max-width: 200px;
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

<!-- Hero Section -->
<div class="hero">
    Welcome to Beauty Shop 💄<br>
    Discover the Best Beauty Products
</div>

<!-- Featured Products -->
<div class="container mt-5">
  <h2 class="mb-4 text-center">✨ Featured Products</h2>
  <div class="row">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="col-md-4">
        <div class="product-card">
          <img src="img/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" class="product-img">
          <h5><?php echo $row['name']; ?></h5>
          <p>₹<?php echo $row['price']; ?></p>
        </div>
      </div>
    <?php } ?>
  </div>
  <div class="text-center">
    <a href="shop.php" class="btn btn-primary mt-3">View All Products</a>
  </div>
</div>

<!-- Footer -->
<footer class="bg-light text-center mt-5 py-3">
  <p>© 2025 Beauty Shop | Designed by Shruti Jain</p>
</footer>

</body>
</html>
