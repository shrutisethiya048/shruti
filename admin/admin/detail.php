<?php
// Database Connection
$conn = mysqli_connect("localhost", "root", "", "your_database_name");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check product id in URL
if (!isset($_GET['id'])) {
    die(" Product ID not provided!");
}

$id = intval($_GET['id']); // Safe integer conversion

// Fetch single product
$query = "SELECT * FROM products WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die(" Product not found in database!");
}

$product = mysqli_fetch_assoc($result);

// Calculate total items in cart
$total_items = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $qty = isset($item['quantity']) ? $item['quantity'] : 1;
        $total_items += $qty;
    }
}

// Check if product image exists
$image_path = "img/" . $product['image'];
if (!file_exists($image_path) || empty($product['image'])) {
    $image_path = "img/default.jpg"; // fallback image
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo htmlspecialchars($product['name']); ?> - Details</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<style>
.product-detail {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 20px;
    margin-top: 30px;
}
.product-img {
    width: 100%;
    max-width: 350px;
    height: 350px;
    object-fit: cover;
    display: block;
    margin: 0 auto 20px auto;
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
<!-- Navbar End -->

<div class="container">
  <div class="product-detail">
    <div class="row">
      <div class="col-md-6">
        <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-img">
      </div>
      <div class="col-md-6">
        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
        <h4>Price: ₹<?php echo $product['price']; ?></h4>
        <p><?php echo !empty($product['description']) ? htmlspecialchars($product['description']) : "No description available."; ?></p>

        <!-- Add to Cart Form -->
        <form method="post" action="cart.php?action=add&id=<?php echo $product['id']; ?>">
          <input type="hidden" name="hidden_name" value="<?php echo htmlspecialchars($product['name']); ?>">
          <input type="hidden" name="hidden_price" value="<?php echo $product['price']; ?>">
          <input type="hidden" name="hidden_image" value="<?php echo htmlspecialchars($product['image']); ?>">

          <div class="form-group">
            <label>Quantity:</label>
            <input type="number" name="quantity" value="1" min="1" class="form-control" style="width:120px;">
          </div>

          <input type="submit" name="add_to_cart" class="btn btn-primary" value="Add to Cart">
          <a href="shop.php" class="btn btn-secondary">Back to Shop</a>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="bg-light text-center mt-5 py-3">
  <p>© 2025 Beauty Shop | Designed by Shruti Jain</p>
</footer>

</body>
</html>
