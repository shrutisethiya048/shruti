<?php
session_start();

// ================== ADD TO CART ==================
if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id = $_GET['id'];
    $name = $_POST['hidden_name'];
    $price = $_POST['hidden_price'];
    $image = $_POST['hidden_image'];
    $quantity = $_POST['quantity'];

    // Agar cart already exist karta hai
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['item_quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$id] = array(
            'item_name'     => $name,
            'item_price'    => $price,
            'item_quantity' => $quantity,
            'item_image'    => $image
        );
    }
}

// ================== REMOVE ITEM ==================
if (isset($_GET['action']) && $_GET['action'] == "remove") {
    $id = $_GET['id'];
    unset($_SESSION['cart'][$id]);
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
        if (!empty($_SESSION['cart'])) {
            $grand_total = 0;

            foreach ($_SESSION['cart'] as $key => $item) {
                $name = $item['item_name'];
                $price = $item['item_price'];
                $quantity = $item['item_quantity'];
                $image = $item['item_image'];

                $total = $price * $quantity;
                $grand_total += $total;
        ?>
                <tr>
                    <td><img src="img/<?= $image ?>" width="70"></td>
                    <td><?= $name ?></td>
                    <td>₹<?= $price ?></td>
                    <td><?= $quantity ?></td>
                    <td>₹<?= $total ?></td>
                    <td>
                        <a href="cart.php?action=remove&id=<?= $key ?>" class="btn btn-danger btn-sm">Remove</a>
                    </td>
                </tr>
        <?php
            }
        ?>
            <tr class="table-secondary">
                <td colspan="4" class="text-end"><strong>Grand Total</strong></td>
                <td colspan="2"><strong>₹<?= $grand_total ?></strong></td>
            </tr>
        <?php
        } else {
            echo "<tr><td colspan='6' class='text-center'>Your cart is empty</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <a href="shop.php" class="btn btn-primary">Continue Shopping</a>
    <a href="checkout.php" class="btn btn-success">Checkout</a>
</div>
</body>
</html>
