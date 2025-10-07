<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "admin_panel");

// Connection check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch categories
$sql = "SELECT * FROM categories";
$categories_arr = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Categories</title>
<style>
    body {font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f8; margin:0; padding:0;}
    .container {width:90%; max-width:1200px; margin:30px auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);}
    h1 {text-align:center; margin-bottom:20px; color:#333;}
    .add-btn {display:inline-block; background-color:#28a745; color:#fff; padding:10px 20px; border-radius:6px; text-decoration:none; margin-bottom:15px; transition:0.3s;}
    .add-btn:hover {background-color:#218838;}
    table {width:100%; border-collapse: collapse;}
    table th, table td {padding:12px 15px; text-align:left;}
    table th {background-color:#007bff; color:#fff;}
    table tr:nth-child(even) {background-color:#f9f9f9;}
    table tr:hover {background-color:#f1f1f1;}
    .btn {padding:5px 10px; border-radius:5px; color:#fff; text-decoration:none; margin-right:5px; font-size:14px;}
    .edit-btn {background-color:#ffc107;}
    .edit-btn:hover {background-color:#e0a800;}
    .delete-btn {background-color:#dc3545;}
    .delete-btn:hover {background-color:#c82333;}
</style>
</head>
<body>
<div class="container">
    <h1>Manage Categories</h1>
    <a href="add_category.php" class="add-btn">+ Add Category</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($categories_arr && $categories_arr->num_rows > 0) {
            while ($row = $categories_arr->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['description']."</td>";
                echo "<td>".$row['created_at']."</td>";
                echo "<td>
                        <a href='edit_category.php?id=".$row['id']."' class='btn edit-btn'>Edit</a>
                        <a href='delete_category.php?id=".$row['id']."' class='btn delete-btn' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align:center;'>No categories found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
