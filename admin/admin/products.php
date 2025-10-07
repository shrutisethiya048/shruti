<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "admin_panel");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products
$products_arr = [];
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_object()) {
        $products_arr[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            display: flex;
            min-height: 100vh;
        }
        /* Sidebar */
        .sidebar {
            width: 220px;
            background: #2c3e50;
            color: #fff;
            display: flex;
            flex-direction: column;
        }
        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #34495e;
            margin: 0;
        }
        .sidebar a {
            color: #fff;
            padding: 15px 20px;
            text-decoration: none;
            border-bottom: 1px solid #34495e;
            display: block;
        }
        .sidebar a:hover {
            background: #34495e;
        }
        .logout {
            margin-top: auto;
            background: #e74c3c;
            text-align: center;
        }
        .logout a {
            display: block;
            color: #fff;
            padding: 15px 20px;
            text-decoration: none;
        }
        .logout a:hover {
            background: #c0392b;
        }
        /* Main content */
        .main {
            flex: 1;
            background: #ecf0f1;
            padding: 30px;
        }
        h1 { margin-top: 0; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background: #2c3e50; color: #fff; }
        a.button {
            padding: 6px 12px;
            text-decoration: none;
            color: #fff;
            border-radius: 4px;
        }
        .edit { background: #4CAF50; }
        .edit:hover { background: #388E3C; }
        .delete { background: #f44336; }
        .delete:hover { background: #c0392b; }
        .add-btn { background: #2980b9; margin-bottom: 15px; display: inline-block; }
        .add-btn:hover { background: #1c5980; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="products.php">Manage Products</a>
        <a href="orders.php">Manage Orders</a>
        <a href="users.php">Manage Users</a>
        <a href="customer.php">Manage Customers</a>
        <a href="categories.php">Manage Categories</a>
        <a href="contact.php">Manage Contact</a>
        <a href="profile.php">Admin Profile</a>
        <div class="logout">
            <a href="logout.php" style="font-weight:bold;">Logout</a>
        </div>
    </div>

    <!-- Main content -->
    <div class="main">
        <h1>Manage Products</h1>
        <a href="add_product.php" class="button add-btn">+ Add New Product</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price (₹)</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($products_arr)): ?>
                <?php foreach($products_arr as $row): ?>
                    <tr>
                        <td><?= $row->id ?></td>
                        <td><?= htmlspecialchars($row->name) ?></td>
                        <td><?= htmlspecialchars($row->description) ?></td>
                        <td><?= $row->price ?></td>
                        <td>
                            <?php if(!empty($row->image)): ?>
                                <img src="assets/images/products/<?= $row->image ?>" width="80" height="80" style="border-radius:5px;">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                           <td>
                        <a href="edit_product?id=<?= $row->id ?>" class="button edit">Edit</a>
                         <a href="delete_product?dlt_products=<?= $row->id ?>" 
                        onclick="return confirm('Are you sure you want to delete this product?')" 
                        class="button delete">Delete</a>
                           </td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="color:red;">No products found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
