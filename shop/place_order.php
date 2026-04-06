<?php
session_start();
// Database Connection
$conn = mysqli_connect("localhost", "root", "", "admin_panel");
if (!$conn) {
    die(" Database Connection Failed: " . mysqli_connect_error());
}

$success = ""; // Message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //  Check if cart is empty
    if (empty($_SESSION['cart'])) {
        $success = " Your cart is empty!";
    } else {
        //  Collect form data safely
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $address  = mysqli_real_escape_string($conn, $_POST['address']);
        $payment  = mysqli_real_escape_string($conn, $_POST['payment']);
        $grand_total = floatval($_POST['total_amount']);

        $insertError = false;

        // ✅ Insert each cart item as separate order
        foreach ($_SESSION['cart'] as $item) {
            $pname   = mysqli_real_escape_string($conn, $item['item_name']);
            $qty     = intval($item['item_quantity']);
            $price   = floatval($item['item_price']);
            $status  = "Pending";
            $created = date("Y-m-d H:i:s");

            $sql = "INSERT INTO orders 
                    (customer_name, product_name, quantity, price, total_amount, status, payment_method, shipping_address, billing_address, created_at)
                    VALUES 
                    ('$fullname', '$pname', $qty, $price, $grand_total, '$status', '$payment', '$address', '$address', '$created')";

            if (!mysqli_query($conn, $sql)) {
                $insertError = true;
                $success = " Insert Error: " . mysqli_error($conn);
                break;
            }
        }

        // If no errors → clear cart & show success
        if (!$insertError) {
            unset($_SESSION['cart']);
            $success = "🎉 Your order has been placed successfully!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Order Status</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
body {
    background: #f0f2f5;
    font-family: 'Segoe UI', sans-serif;
    display: flex;
    justify-content:center;
    align-items: center;
    min-height: 100vh;
}
.message-box {
    text-align:center;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0px 6px 15px rgba(0,0,0,0.1);
    max-width: 500px;
    background: #ffffff;
}
.message-box h3 {
    font-size: 1.5rem;
    margin-bottom: 20px;
    color: #28a745;
}
.btn-custom {
    margin-top: 15px;
    background: linear-gradient(135deg, #ff758c, #ff7eb3);
    color: #fff;
    border: none;
    border-radius: 30px;
    padding: 12px 25px;
    font-weight: bold;
    text-decoration: none;
    display: inline-block;
}
.btn-custom:hover {
    background: linear-gradient(135deg, #ff5f7e, #ff4a91);
    transform: scale(1.05);
}
</style>
</head>
<body>

<div class="message-box">
    <h3><?= htmlspecialchars($success) ?></h3>
    <a href="shop.php" class="btn-custom">Continue Shopping 🛍</a>
</div>
</body>
</html>