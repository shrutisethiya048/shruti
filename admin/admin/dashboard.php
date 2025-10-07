<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body {margin:0; font-family:'Segoe UI', sans-serif; display:flex; min-height:100vh; background:#f4f6f9;}
.sidebar {width:220px; background:#1f2937; color:white; display:flex; flex-direction:column; position:fixed; height:100vh;}
.sidebar h2 {text-align:center; padding:20px 0; border-bottom:1px solid #374151; margin:0;}
.sidebar a {color:white; padding:15px 20px; text-decoration:none; border-bottom:1px solid #374151; display:flex; align-items:center; gap:10px;}
.sidebar a:hover {background:#374151;}
.logout {margin-top:auto; background:#ef4444; text-align:center;}
.logout a {display:block; color:white; padding:15px 20px; text-decoration:none;}
.logout a:hover {background:#dc2626;}
.main {margin-left:220px; padding:30px; flex:1;}
h1 {margin-top:0; color:#111827;}
.dashboard {display:flex; flex-wrap:wrap; gap:20px;}
.card {flex:1 1 200px; background:linear-gradient(135deg,#2563eb,#3b82f6); color:white; padding:25px; border-radius:12px; text-align:center; box-shadow:0 8px 20px rgba(0,0,0,0.15); position:relative;}
.card i {font-size:30px; position:absolute; top:15px; right:15px; opacity:0.2;}
.card h2 {font-size:2.5em; margin:0;}
.card p {margin-top:10px; font-size:1.1em;}
@media (max-width:768px){.main{margin-left:0; padding:20px;}.sidebar{position:relative; width:100%; height:auto;}.dashboard{flex-direction:column;}}

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
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            background: #2980b9;
            border-radius: 4px;
        }
        a.button:hover { background: #1c5980; }
        .delete { background: #e74c3c; }
        .delete:hover { background: #c0392b; }
</style>
</head>
<body>

<?php
include_once("model.php");
$obj = new Model();
?>
<div class="sidebar">
<h2>BEAUTY SHOP</h2>
        <a href="dashboard">Dashboard</a>
        <a href="products">Manage Products</a>
        <a href="orders">Manage Orders</a>
        <a href="users">Manage Users</a>
		<a href="customer">Manage customer</a>
		<a href="categories">Manage categories</a>
		<a href="contact">Manage contact</a>	
        <a href="profile">Admin profile</a>
        <div class="logout">
        <a href="./admin_logout" style="color:red; font-weight:bold;">Logout</a>
</div>
</div>

<div class="main">
<div class="dashboard">

<div class="card">
<i class="fas fa-box"></i>
<h2>
<?php
$result = $obj->conn->query("SELECT COUNT(*) AS total FROM products");
$row = $result->fetch_assoc();
echo $row['total'];
?>
</h2>
<p>Total Products</p>
</div>

<div class="card">
<i class="fas fa-shopping-cart"></i>
<h2>
<?php
$result = $obj->conn->query("SELECT COUNT(*) AS total FROM orders");
$row = $result->fetch_assoc();
echo $row['total'];
?>
</h2>
<p>Total Orders</p>
</div>

<div class="card">
<i class="fas fa-users"></i>
<h2>
<?php
$result = $obj->conn->query("SELECT COUNT(*) AS total FROM users");
$row = $result->fetch_assoc();
echo $row['total'];
?>
</h2>
<p>Total Users</p>
</div>

</div>
</div>

</body>
</html>
