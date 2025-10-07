<?php
include_once("model.php");	
$obj = new model();

// Fetch all customers
$customers = $obj->fetchCustomers();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Customers</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        h2 { margin-bottom: 20px; }
        a { text-decoration: none; color: blue; }
        img { width: 50px; height: auto; }
    </style>
</head>
<body>

<h2>Manage Customers</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Firstname</th>
        <th>Lastname</th>
		<th>Full Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Gender</th>
        <th>Languages</th>
        <th>Image</th>
        <th class="text-center">Action</th>
    </tr>

    <?php if(!empty($customers)) { 
        foreach($customers as $data) { ?>
        <tr>
            <td><?= $data->id ?></td>
            <td><?= $data->firstname ?? '' ?></td>
            <td><?= $data->lastname ?? '' ?></td>
			<td><?= $data->firstname . ' ' . $data->lastname ?></td>
            <td><?= $data->email ?? '' ?></td>
            <td><?= $data->mobile ?? '' ?></td>
            <td><?= $data->gender ?? '' ?></td>
            <td><?= $data->lag ?? '' ?></td>
            <td>
                <?php if(!empty($data->image)) { ?>
					<img src="assets/images/customer/<?= $data->image ?>" width="80" height="80" style="border-radius:5px;">
                <?php } 
				else { ?>
                    echo "No Image";
                <?php } ?>
            </td>
            <td>
                <a href="edit_customer.php?id=<?= $data->id ?>">Edit</a> | 
                <a href="delete_customer.php?id=<?= $data->id ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php } 
    } else { ?>
        <tr><td colspan="9">No customers found.</td></tr>
    <?php } ?>
</table>

</body>
</html>
