<?php
// ✅ Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
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
    $_SESSION['cart'] = [];   // empty array
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
body { padding: 30px; font-family: Arial, sans-serif; }
table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
img { width: 80px; height: 80px; object-fit: cover; }
</style>
</head>
<body>

<h2>Your Cart</h2>

<?php if (!empty($cart)) { ?>
<table class="table table-bordered">
    <thead>
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
            <td><?= $item['item_quantity'] ?></td>
            <td>₹<?= number_format($subtotal, 2) ?></td>
            <td>
                <a href="cart.php?action=remove&id=<?= $id ?>" class="btn btn-danger btn-sm">Remove</a>
            </td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <td colspan="4" style="text-align:right;"><strong>Total:</strong></td>
            <td colspan="2"><strong>₹<?= number_format($total, 2) ?></strong></td>
        </tr>
    </tbody>
</table>

<a href="cart.php?action=clear" class="btn btn-danger"
   onclick="return confirm('Are you sure you want to clear the cart?');">Clear Cart</a>
<a href="index.php" class="btn btn-success">Continue Shopping</a>
<a href="checkout.php" class="btn btn-warning">Checkout</a>

<?php } else { ?>
    <p>Your cart is empty. <a href="index.php">Go Shopping</a></p>
<?php } ?>

</body>
</html>
