<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: authentication-login.php");
    exit();
}

include('db_connection.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error = "";

if($id > 0){
    $res = mysqli_query($conn, "SELECT * FROM categories WHERE id=$id");
    if(mysqli_num_rows($res) == 0){
        die("Category not found!");
    }
    $category = mysqli_fetch_assoc($res);
    $name = $category['name'];
    $description = $category['description'];
} else {
    die("Invalid Category ID!");
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if(!empty($name)){
        $query = "UPDATE categories SET name='$name', description='$description' WHERE id=$id";
        if(mysqli_query($conn, $query)){
            header("Location: categories.php");
            exit();
        } else {
            $error = "Query Failed: " . mysqli_error($conn);
        }
    } else {
        $error = "Category name is required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Category</title>
<style>
/* Same CSS as add_category.php */
body {margin:0; font-family:Arial,sans-serif; display:flex; min-height:100vh;}
.sidebar {width:220px; background:#2c3e50; color:#fff; display:flex; flex-direction:column;}
.sidebar h2 {text-align:center; padding:20px 0; border-bottom:1px solid #34495e; margin:0;}
.sidebar a {color:#fff; padding:15px 20px; text-decoration:none; border-bottom:1px solid #34495e;}
.sidebar a:hover {background:#34495e;}
.logout {margin-top:auto; background:#e74c3c; text-align:center;}
.logout a {display:block; color:#fff; padding:15px 20px; text-decoration:none;}
.logout a:hover {background:#c0392b;}
.main {flex:1; background:#ecf0f1; padding:30px;}
h1 {margin-top:0;}
form {background:#fff; padding:20px; border-radius:8px; box-shadow:0 0 5px rgba(0,0,0,0.1); max-width:500px;}
input[type=text], textarea {width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;}
input[type=submit] {padding:10px 20px; background:#27ae60; color:#fff; border:none; border-radius:5px; cursor:pointer;}
input[type=submit]:hover {background:#219150;}
.error {color:red; margin-bottom:10px;}
</style>
</head>
<body>
<div class="sidebar">
<h2>Admin Panel</h2>
<a href="dashboard.php">Dashboard</a>
<a href="products.php">Manage Products</a>
<a href="orders.php">Manage Orders</a>
<a href="users.php">Manage Users</a>
<a href="categories.php">Manage Categories</a>
<div class="logout"><a href="categories.php?logout=true">Logout</a></div>
</div>

<div class="main">
<h1>Edit Category</h1>
<?php if($error) echo "<p class='error'>$error</p>"; ?>
<form method="POST" action="">
<input type="text" name="name" placeholder="Category Name" value="<?php echo htmlspecialchars($name); ?>" required>
<textarea name="description" placeholder="Description"><?php echo htmlspecialchars($description); ?></textarea>
<input type="submit" value="Update Category">
</form>
</div>
</body>
</html>
