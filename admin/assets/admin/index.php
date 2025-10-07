<?php
session_start();

// Login check
if(!isset($_SESSION['username'])){
    header("Location: authentication-login.php");
    exit;
}

// Logout
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: authentication-login.php");
    exit;
}

include('db_connection.php'); // Database connection
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <style>
      body {
          margin: 0;
          font-family: Arial, sans-serif;
          background: #f4f4f4;
      }
      .sidebar {
          width: 220px;
          height: 100vh;
          background: #2c3e50;
          color: #fff;
          position: fixed;
          top: 0;
          left: 0;
          padding-top: 20px;
      }
      .sidebar h2 {
          text-align: center;
          margin-bottom: 20px;
      }
      .sidebar ul {
          list-style: none;
          padding: 0;
      }
      .sidebar ul li {
          padding: 15px;
          text-align: center;
      }
      .sidebar ul li a {
          color: #fff;
          text-decoration: none;
          display: block;
      }
      .sidebar ul li a:hover {
          background: #34495e;
      }
      .content {
          margin-left: 220px;
          padding: 20px;
      }
      .card {
          background: #fff;
          padding: 20px;
          margin-bottom: 20px;
          border-radius: 8px;
          box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      }
  </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="product.php">Manage Products</a></li>
            <li><a href="orders.php">Manage Orders</a></li>
            <li><a href="users.php">Manage Users</a></li>
            <li><a href="index.php?logout=true">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Welcome to Admin Dashboard</h1>
        <div class="card">
            <h2>Dashboard Overview</h2>
            <p>Here you can manage products, orders, and users.</p>
        </div>
    </div>
</body>
</html>
