<?php
include_once("model.php");
$obj = new model();

if(!isset($_SESSION['a_id'])){
    header("Location: admin_login.php");
    exit;
}

$id = $_GET['id'] ?? 0;
if($id == 0){
    echo "<script>alert('Invalid Product ID'); window.location='control.php/products';</script>";
    exit;
}

// Fetch product details
$where = ["id" => $id];
$run = $obj->select_where('products', $where);
if($run && $run->num_rows > 0){
    $product = $run->fetch_assoc();
}else{
    echo "<script>alert('Product not found'); window.location='control.php/products';</script>";
    exit;
}

// Handle form submission
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Image upload
    if(!empty($_FILES['image']['name'])){
        $image = time() . "_" . $_FILES['image']['name'];
        $path = "assets/images/products/" . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);

        // Delete old image
        if(file_exists("assets/images/products/".$product['image']) && $product['image'] != ''){
            unlink("assets/images/products/".$product['image']);
        }
    } else {
        $image = $product['image']; // Old image
    }

    // Update product
    $updateData = [
        "name" => $name,
        "description" => $description,
        "price" => $price,
        "category" => $category,
        "image" => $image
    ];

    $obj->update('products', $updateData, ["id" => $id]);

    echo "<script>alert('Product updated successfully!'); window.location='control.php/products';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Product</title>
<style>
body { margin:0; font-family:Arial; display:flex; min-height:100vh; }
.sidebar{ width:220px; background:#2c3e50; color:#fff; display:flex; flex-direction:column; }
.sidebar h2{ text-align:center; padding:20px 0; border-bottom:1px solid #34495e; margin:0;}
.sidebar a{ color:#fff; padding:15px 20px; text-decoration:none; border-bottom:1px solid #34495e;}
.sidebar a:hover{ background:#34495e; }
.main{ flex:1; background:#ecf0f1; padding:30px;}
h1{ margin-top:0;}
form{ background:#fff; padding:20px; border-radius:8px; width:500px;}
label{ display:block; margin-top:10px;}
input[type="text"], input[type="number"], textarea{ width:100%; padding:8px; margin-top:5px;}
input[type="file"]{ margin-top:5px; }
input[type="submit"]{ margin-top:15px; padding:10px 20px; background:#2980b9; color:#fff; border:none; cursor:pointer;}
input[type="submit"]:hover{ background:#1c5980;}
img{ margin-top:10px; max-width:100px;}
</style>
</head>
<body>
<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="control.php/dashboard">Dashboard</a>
    <a href="control.php/products">Manage Products</a>
    <a href="control.php/orders">Manage Orders</a>
    <a href="control.php/users">Manage Users</a>
    <a href="control.php/customer">Manage Customers</a>
    <a href="control.php/Category">Manage Categories</a>
    <a href="control.php/Contact">Manage Contact</a>
    <a href="control.php/profile">Admin profile</a>
    <a href="logout" style="color:red; font-weight:bold;">Logout</a>
</div>

<div class="main">
    <h1>Edit Product</h1>
    <form method="post" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

        <label>Description:</label>
        <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>

        <label>Price:</label>
        <input type="number" name="price" value="<?php echo $product['price']; ?>" required>

        <label>Category:</label>
        <input type="text" name="category" value="<?php echo isset($product['category']) ? htmlspecialchars($product['category']) : ''; ?>" required>


        <label>Image:</label>
        <input type="file" name="image">
        <br>
        <img src="assets/images/products/<?php echo $product['image']; ?>" alt="Product Image">

        <input type="submit" name="submit" value="Update Product">
    </form>
</div>
</body>
</html>
