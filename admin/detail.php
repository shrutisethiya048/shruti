<?php
session_start();
include("config.php");

// Check product id
if (!isset($_GET['id'])) die("Product ID not provided!");
$id = intval($_GET['id']);

// Fetch product
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id LIMIT 1");
if (!$result || mysqli_num_rows($result)==0) die("Product not found!");
$product = mysqli_fetch_assoc($result);

// Initialize cart
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

// Handle Add to Cart form submission
if (isset($_POST['add_to_cart'])) {
    $quantity = intval($_POST['quantity']);
    $quantity = $quantity < 1 ? 1 : $quantity;

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['item_quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$id] = [
            'item_name' => $product['name'],
            'item_price' => $product['price'],
            'item_quantity' => $quantity,
            'item_image' => $product['image']
        ];
    }
    header("Location: cart.php");
    exit();
}

// Total items count
$total_items = 0;
foreach ($_SESSION['cart'] as $item) $total_items += $item['item_quantity'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($product['name']) ?> - Details</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
.product-detail { border: 1px solid #ddd; border-radius:10px; padding:20px; margin-top:30px; }
.product-img { width:100%; max-width:350px; height:350px; object-fit:cover; display:block; margin:0 auto 20px auto; }
</style>
</head>
<body>
<div class="container mt-5">
<div class="product-detail row">
    <div class="col-md-6">
        <img src="assets/images/products/<?= $product['image'] ?>" class="product-img" alt="<?= htmlspecialchars($product['name']) ?>">
    </div>
    <div class="col-md-6">
        <h2><?= htmlspecialchars($product['name']) ?></h2>
        <h4>Price: ₹<?= $product['price'] ?></h4>
        <p><?= !empty($product['description']) ? htmlspecialchars($product['description']) : "No description available."; ?></p>

        <form method="post">
            <div class="form-group">
                <label>Quantity:</label>
                <input type="number" name="quantity" value="1" min="1" class="form-control" style="width:120px;">
            </div>
            <input type="submit" name="add_to_cart" class="btn btn-primary mt-2" value="Add to Cart">
            <a href="shop.php" class="btn btn-secondary mt-2">Back to Shop</a>
        </form>
    </div>
</div>
</div>
</body>
</html>
