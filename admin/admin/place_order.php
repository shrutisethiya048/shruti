<?php
session_start();
$conn = mysqli_connect("localhost","root","","admin_panel");

if(!$conn) die("DB Connection failed: ".mysqli_connect_error());

$success = ''; // Message to show

if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_SESSION['cart'])){

    $fullname = $_POST['fullname'];
    $address  = $_POST['address'];
    $payment  = $_POST['payment'];
    $grand_total = $_POST['total_amount'];

    foreach($_SESSION['cart'] as $item){
        $pname    = $item['item_name'];
        $qty      = $item['item_quantity'];
        $price    = $item['item_price'];
        $status   = "Pending";
        $created  = date("Y-m-d H:i:s");

        $sql = "INSERT INTO orders
        (customer_name, product_name, quantity, price, status, created_at, shipping_address, billing_address)
        VALUES
        ('$fullname','$pname',$qty,$price,'$status','$created','$address','$address')";

        if(!mysqli_query($conn,$sql)){
            $success = "❌ Insert Error: ".mysqli_error($conn);
        }
    }

    unset($_SESSION['cart']);
    if($success=='') $success = "🎉 Your order has been placed successfully!";
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
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
.message-box {
    text-align: center;
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
