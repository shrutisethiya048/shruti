<?php
include_once("model.php");
$obj = new model();

// Fetch all orders
$orders = $obj->fetchOrders();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { margin-bottom: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        a { text-decoration: none; padding: 5px 10px; border-radius: 3px; margin-right: 5px; }
        .edit { background-color: #f0f0f0; }
        .delete { background-color: #ffdddd; }
    </style>
</head>
<body>

<h2>All Orders</h2>

<table>
    <tr>
        <th>Order ID</th>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Status</th>
		<th>Shipping Address</th>
        <th>Billing Address</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>

    <?php if(!empty($orders)) { 
        foreach($orders as $row) { ?>
            <tr>
                <td><?= $row->order_id ?></td>
                <td><?= $row->customer_name ?></td>
                <td><?= $row->product_name ?></td>
                <td><?= $row->quantity ?></td>
                 <td><?= $row->price ?></td>
                 <td><?= $row->status ?></td>
                  <td><?= htmlspecialchars($row->shipping_address) ?></td>
                  <td><?= htmlspecialchars($row->billing_address) ?></td>
                   <td><?= $row->created_at ?></td>
                <td>
				<a href="edit_order.php?id=<?= $row->order_id ?>" class="edit">Edit</a>
                <a href="delete_order.php?id=<?= $row->order_id ?>" 
               onclick="return confirm('Are you sure you want to delete this Order?')" 
               class="delete">Delete</a>
                </td>
            </tr>
        <?php } 
    } else { ?>
        <tr><td colspan="8">No orders found.</td></tr>
    <?php } ?>
</table>

</body>
</html>
