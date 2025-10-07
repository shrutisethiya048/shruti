<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Redirect to cart if cart is empty
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">🧾 Checkout</h2>

    <!-- Order Summary -->
    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Price (₹)</th>
                <th>Quantity</th>
                <th>Total (₹)</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $grand_total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $name     = $item['item_name'];
            $price    = $item['item_price'];
            $quantity = $item['item_quantity'];
            $image    = $item['item_image'];

            $total = $price * $quantity;
            $grand_total += $total;
        ?>
            <tr>
                <td><img src="assets/images/products/<?= htmlspecialchars($image) ?>" width="70"></td>
                <td><?= htmlspecialchars($name) ?></td>
                <td>₹<?= $price ?></td>
                <td><?= $quantity ?></td>
                <td>₹<?= $total ?></td>
            </tr>
        <?php } ?>
            <tr class="table-secondary">
                <td colspan="4" class="text-end"><strong>Grand Total</strong></td>
                <td><strong>₹<?= $grand_total ?></strong></td>
            </tr>
        </tbody>
    </table>

    <!-- Billing Form -->
    <h3 class="mt-5">🧍 Billing Details</h3>
    <form method="post" action="place_order.php" class="mt-3">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="fullname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Payment Method</label>
            <select name="payment" class="form-select" required>
                <option value="COD">Cash on Delivery</option>
                <option value="Card">Credit/Debit Card</option>
                <option value="UPI">UPI</option>
            </select>
        </div>
        <input type="hidden" name="total_amount" value="<?= $grand_total ?>">
        <button type="submit" class="btn btn-success">Place Order</button>
    </form>

    <a href="cart.php" class="btn btn-primary mt-3">Back to Cart</a>
</div>
</body>
</html>
