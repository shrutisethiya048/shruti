<?php
include_once("model.php");
$obj = new model();

if (isset($_POST['submit'])) {
    $name        = $_POST['name'];
    $description = $_POST['description'];
    $price       = $_POST['price'];

    // Image upload
    $image = "";
    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "assets/images/products/" . $image);
    }

    // Insert query
    $sql = "INSERT INTO products (name, description, price, image) 
            VALUES ('$name', '$description', '$price', '$image')";
    
    if (mysqli_query($obj->conn, $sql)) {
        echo "<script>alert('✅ Product added successfully!'); 
        window.location='control.php/products';</script>";
    } else {
        echo "<script>alert('❌ Error: " . mysqli_error($obj->conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <style>
        body { margin: 0; font-family: Arial; display: flex; min-height: 100vh; }
        .sidebar { width: 220px; background: #2c3e50; color: #fff; display: flex; flex-direction: column; }
        .sidebar h2 { text-align: center; padding: 20px 0; border-bottom: 1px solid #34495e; margin: 0; }
        .sidebar a { color: #fff; padding: 15px 20px; text-decoration: none; border-bottom: 1px solid #34495e; }
        .sidebar a:hover { background: #34495e; }
        .logout { margin-top: auto; background: #e74c3c; text-align: center; }
        .logout a { display: block; color: #fff; padding: 15px 20px; text-decoration: none; }
        .logout a:hover { background: #c0392b; }
        .main { flex: 1; background: #ecf0f1; padding: 30px; }
        h1 { margin-top: 0; }
        form { background: #fff; padding: 20px; border-radius: 8px; width: 500px; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="number"], textarea, select { width: 100%; padding: 8px; margin-top: 5px; }
        input[type="submit"] { margin-top: 15px; padding: 10px 20px; background: #2980b9; color: #fff; border: none; cursor: pointer; }
        input[type="submit"]:hover { background: #1c5980; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="control.php/dashboard">Dashboard</a>
        <a href="control.php/products">Manage Products</a>
        <a href="control.php/orders">Manage Orders</a>
        <a href="control.php/customer">Manage Customers</a>
        <a href="control.php/users">Manage Users</a>
		<a href="control.php/category">Manage categories</a>
		<a href="control.php/Contact">Manage Contact</a>
        <div class="logout">
        <a href="logout" style="color:red; font-weight:bold;">Logout</a>
        </div>
    </div>

    <!-- Main content -->
    <div class="main">
        <h1>Add New Product</h1>
        <form method="post" enctype="multipart/form-data">
            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Description:</label>
            <textarea name="description" required></textarea>

            <label>Price:</label>
            <input type="number" name="price" required step="0.01">

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" required>

            <input type="submit" name="submit" value="Add Product">
        </form>
    </div>
</body>
</html>
