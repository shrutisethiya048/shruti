<?php
// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// ✅ Increase quantity
if (isset($_GET['action']) && $_GET['action'] === "increase" && isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['item_quantity'] += 1;
    }
    header("Location: cart.php");
    exit;
}

// ✅ Decrease quantity
if (isset($_GET['action']) && $_GET['action'] === "decrease" && isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_SESSION['cart'][$id]) && $_SESSION['cart'][$id]['item_quantity'] > 1) {
        $_SESSION['cart'][$id]['item_quantity'] -= 1;
    }
    header("Location: cart.php");
    exit;
}

// ✅ Remove single item
if (isset($_GET['action']) && $_GET['action'] === "remove" && isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
    header("Location: cart.php");
    exit;
}

// ✅ Clear entire cart
if (isset($_GET['action']) && $_GET['action'] === "clear") {
    $_SESSION['cart'] = [];
    header("Location: cart.php");
    exit;
}

$cart = $_SESSION['cart'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Shopping Cart</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
body { padding: 30px; font-family: Arial, sans-serif; background: #f8f9fa; }
table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
th, td { padding: 10px; border: 1px solid #ddd; text-align: center; vertical-align: middle; }
img { width: 80px; height: 80px; object-fit: cover; }
.qty-btn { width: 30px; height: 30px; padding: 0; font-weight: bold; }
</style>
</head>
<body>

<div class="container">
<h2 class="mb-4">Your Cart</h2>

<?php if (!empty($cart)) { ?>
<table class="table table-bordered table-hover">
    <thead class="thead-light">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $total = 0;
    foreach ($cart as $id => $item):
        $subtotal = $item['item_price'] * $item['item_quantity'];
        $total += $subtotal;
    ?>
        <tr>
            <td>
                <?php if (!empty($item['item_image']) && file_exists("assets/images/products/".$item['item_image'])): ?>
                    <img src="assets/images/products/<?= htmlspecialchars($item['item_image']) ?>" alt="<?= htmlspecialchars($item['item_name']) ?>">
                <?php else: ?>
                    No Image
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($item['item_name']) ?></td>
            <td>₹<?= number_format($item['item_price'], 2) ?></td>
            <td>
                <a href="cart.php?action=decrease&id=<?= $id ?>" class="btn btn-secondary qty-btn">−</a>
                <?= $item['item_quantity'] ?>
                <a href="cart.php?action=increase&id=<?= $id ?>" class="btn btn-secondary qty-btn">+</a>
            </td>
            <td>₹<?= number_format($subtotal, 2) ?></td>
            <td>
                <a href="cart.php?action=remove&id=<?= $id ?>" class="btn btn-sm btn-danger">Remove</a>
            </td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <td colspan="4" class="text-right"><strong>Total:</strong></td>
            <td colspan="2"><strong>₹<?= number_format($total, 2) ?></strong></td>
        </tr>
    </tbody>
</table>

<div class="mb-3">
    <a href="cart.php?action=clear" class="btn btn-danger"
       onclick="return confirm('Are you sure you want to clear the cart?');">Clear Cart</a>
    <a href="index.php" class="btn btn-success">Continue Shopping</a>
    <a href="checkout.php" class="btn btn-warning">Checkout</a>
</div>

<?php } else { ?>
    <div class="alert alert-info">Your cart is empty. <a href="index.php">Go Shopping</a></div>
<?php } ?>

</div>
</body>
</html>
<?php include("footer.php"); ?>
