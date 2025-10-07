<?php
session_start();

// Check if admin is logged in
if(!isset($_SESSION['admin'])){
    header("Location: authentication-login.php");
    exit();
}

include('db_connection.php');

// Form submission
if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Simple validation
    if($name == ""){
        $error = "Category name is required!";
    } else {
        $query = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";
        if(mysqli_query($conn, $query)){
            $success = "Category added successfully!";
        } else {
            $error = "Error: ".mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Category</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        textarea {
            resize: none;
        }
        .btn {
            background-color: #28a745;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover {
            background-color: #218838;
        }
        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 6px;
        }
        .error { background-color: #f8d7da; color: #721c24; }
        .success { background-color: #d4edda; color: #155724; }
        a.back {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Category</h2>

        <?php if(isset($error)) { echo '<div class="message error">'.$error.'</div>'; } ?>
        <?php if(isset($success)) { echo '<div class="message success">'.$success.'</div>'; } ?>

        <form method="POST" action="">
            <label for="name">Category Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter category name">

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" placeholder="Enter description"></textarea>

            <input type="submit" name="submit" value="Add Category" class="btn">
        </form>

        <a href="categories.php" class="back">← Back to Categories</a>
    </div>
</body>
</html>
