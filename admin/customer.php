<?php
include_once("model.php");	
$obj = new model();

// Fetch all customers
$customers = $obj->select('customer'); // returns array of stdClass objects
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Customers</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f9f9f9; }
        h2 { margin-bottom: 20px; }
        table { border-collapse: collapse; width: 100%; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #007bff; color: #fff; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        a { text-decoration: none; padding: 5px 10px; border-radius: 3px; color: #fff; }
        .button.edit { background: #28a745; }
        .button.delete { background: #dc3545; }
        .button.status { padding: 5px 8px; border-radius: 3px; color: #fff; }
        .status-block { background: #dc3545; }
        .status-unblock { background: #28a745; }
        img { width: 80px; height: 80px; border-radius: 5px; object-fit: cover; }
        td img { display: block; margin: 0 auto; }
    </style>
</head>
<body>

<h2>Manage Customers</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php if(!empty($customers)) { 
        foreach($customers as $c) { 
            // Handle missing status column
            $status = isset($c->status) ? $c->status : "Unblock";
        ?>
        <tr>
            <td><?= $c->id ?></td>
            <td><?= htmlspecialchars(($c->firstname ?? '') . ' ' . ($c->lastname ?? '')) ?></td>
            <td><?= htmlspecialchars($c->email ?? '') ?></td>
            <td><?= htmlspecialchars($c->mobile ?? '') ?></td>
            <td>
                <?php if(!empty($c->image) && file_exists("assets/images/customer/".$c->image)) { ?>
                    <img src="assets/images/customer/<?= htmlspecialchars($c->image) ?>" alt="<?= htmlspecialchars($c->firstname . ' ' . $c->lastname) ?>">
                <?php } else { ?>
                    No Image
                <?php } ?>
            </td>
            <td>
                <a href="control.php/status_customer?status_customer=<?= $c->id ?>" 
                   class="button status <?= $status=='Block'?'status-unblock':'status-block' ?>">
                   <?= $status=='Block'?'Unblock':'Block' ?>
                </a>
            </td>
            <td>
                <a href="edit_customer.php?id=<?= $c->id ?>" class="button edit">Edit</a>
                <a href="delete_customer.php?id=<?= $c->id ?>" onclick="return confirm('Are you sure?')" class="button delete">Delete</a>
            </td>
        </tr>
    <?php } 
    } else { ?>
        <tr><td colspan="7" style="text-align:center;">No customers found.</td></tr>
    <?php } ?>
</table>

</body>
</html>
