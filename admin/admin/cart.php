<?php
session_start();
include("config.php");
if (isset($_GET['remove'])) {
    $remove_id = intval($_GET['remove']);
    unset($_SESSION['cart'][$remove_id]);
    header("Location: cart.php");
    exit();
}

// Update quantities
if (isset($_POST['update'])) {
    foreach ($_POST['qty'] as $id => $quantity) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['item_quantity'] = max(1, intval($quantity));
        }
    }
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Shopping Cart</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>🛒 Your Shopping Cart</h2>

    <?php if (!empty($_SESSION['cart'])) { ?>
    <form method="post">
        <table class="table table-bordered mt-3 table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price (₹)</th>
                    <th>Quantity</th>
                    <th>Total (₹)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $grand_total = 0;
            foreach ($_SESSION['cart'] as $id => $item) {
                $name     = $item['item_name'];
                $price    = $item['item_price'];
                $quantity = $item['item_quantity'];
                $image    = $item['item_image'];
                $total    = $price * $quantity;
                $grand_total += $total;
            ?>
                <tr>
                    <td><img src="assets/images/products/<?= htmlspecialchars($image) ?>" width="70"></td>
                    <td><?= htmlspecialchars($name) ?></td>
                    <td>₹<?= $price ?></td>
                    <td>
                        <input type="number" name="qty[<?= $id ?>]" value="<?= $quantity ?>" min="1" class="form-control" style="width:80px;">
                    </td>
                    <td>₹<?= $total ?></td>
                    <td>
                        <a href="cart.php?remove=<?= $id ?>" class="btn btn-danger btn-sm">Remove</a>
                    </td>
                </tr>
            <?php } ?>
                <tr class="table-secondary">
                    <td colspan="4" class="text-end"><strong>Grand Total</strong></td>
                    <td colspan="2"><strong>₹<?= $grand_total ?></strong></td>
                </tr>
            </tbody>
        </table>
        <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
        <a href="shop.php" class="btn btn-primary">Continue Shopping</a>
    </form>
    <?php } else { ?>
        <p class="text-center mt-3">Your cart is empty.</p>
        <a href="shop.php" class="btn btn-primary">Go to Shop</a>
    <?php } ?>
</div>
</body>
</html>
