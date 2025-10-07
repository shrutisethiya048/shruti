<?php
session_start();

// Handle form submission
$success = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $fullname = $_POST['fullname'] ?? '';
    $address  = $_POST['address'] ?? '';
    $payment  = $_POST['payment'] ?? '';

    if(!empty($fullname) && !empty($address) && !empty($payment) && !empty($_SESSION['cart'])){
        // Store order details in session (or database)
        $_SESSION['order'] = [
            'fullname' => $fullname,
            'address'  => $address,
            'payment'  => $payment,
            'cart'     => $_SESSION['cart']
        ];

        // Clear cart after order
        unset($_SESSION['cart']);

        $success = "🎉 Your order has been placed successfully!";
    } else {
        $success = "⚠️ Please fill all fields and make sure your cart is not empty.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Place Order - Beauty Store</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    body {
        background: #ffffff;
        font-family: 'Segoe UI', sans-serif;
    }
    .container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .message-box {
        text-align: center;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 6px 15px rgba(0,0,0,0.1);
        max-width: 500px;
        background: #f8f9fa;
    }
    .btn-custom {
        margin-top: 20px;
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

<div class="container">
    <?php if($success != ""): ?>
        <div class="message-box">
            <h3><?php echo $success; ?></h3>
            <a href="shop.php" class="btn-custom">Continue Shopping 🛍</a>
        </div>
    <?php else: ?>
            <a href="shop.php" class="btn-custom">Go to Shop</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
