<?php
include_once("model.php");
$obj = new model();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $order = $obj->conn->query("SELECT * FROM orders WHERE order_id='$id'")->fetch_object();
} else {
    header("Location: orders.php");
    exit;
}

if(isset($_POST['update_order'])) {
    $data = [
        "customer_name" => $_POST['customer_name'],
        "product_name"  => $_POST['product_name'],
        "quantity"      => $_POST['quantity'],
        "status"        => $_POST['status'],
        "shipping_address" => $_POST['shipping_address'],
        "billing_address"  => $_POST['billing_address']
    ];
    $obj->update("orders", $data, ["order_id"=>$id]);
    echo "<script>
        alert('Order updated successfully');
        window.location='orders.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Order</title>
</head>
<body>

<h2>Edit Order #<?= $order->order_id ?></h2>

<form method="post">
    <label>Customer Name:</label><br>
    <input type="text" name="customer_name" value="<?= htmlspecialchars($order->customer_name) ?>"><br><br>

    <label>Product Name:</label><br>
    <input type="text" name="product_name" value="<?= htmlspecialchars($order->product_name) ?>"><br><br>

    <label>Quantity:</label><br>
    <input type="number" name="quantity" value="<?= (int)$order->quantity ?>"><br><br>

    <label>Status:</label><br>
    <select name="status">
        <option value="pending" <?= $order->status=='pending'?'selected':'' ?>>Pending</option>
        <option value="completed" <?= $order->status=='completed'?'selected':'' ?>>Completed</option>
    </select><br><br>

    <label>Shipping Address:</label><br>
    <textarea name="shipping_address" rows="3"><?= htmlspecialchars($order->shipping_address) ?></textarea><br><br>

    <label>Billing Address:</label><br>
    <textarea name="billing_address" rows="3"><?= htmlspecialchars($order->billing_address) ?></textarea><br><br>

    <button type="submit" name="update_order">Update Order</button>
</form>

</body>
</html>
