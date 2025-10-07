<?php
session_start();
include_once("model.php");
$obj = new model();

// Check admin session
if(!isset($_SESSION['a_id'])){
    header("Location: admin_login.php");
    exit;
}

// Get customer ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($id <= 0){
    echo "<script>alert('Invalid Customer ID'); window.location='control.php/customer';</script>";
    exit;
}

// Fetch customer
$customerResult = $obj->select_where("customer", ["id"=>$id]);
if($customerResult && $customerResult->num_rows > 0){
    $customer = $customerResult->fetch_assoc();
} else {
    echo "<script>alert('Customer not found'); window.location='control.php/customer';</script>";
    exit;
}

// Handle update form
if(isset($_POST['submit'])){
    $updateData = [
        "firstname" => $_POST['firstname'],
        "lastname"  => $_POST['lastname'],
        "email"     => $_POST['email'],
        "mobile"    => $_POST['mobile'],
        "gender"    => $_POST['gender']
    ];

    $obj->update("customer", $updateData, ["id"=>$id]);

    echo "<script>
        alert('Customer updated successfully'); 
        window.location='control.php/customer';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Customer</title>
<style>
body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
h2 { margin-bottom: 20px; }
form { background: #fff; padding: 20px; border-radius: 8px; max-width: 500px; }
label { display:block; margin-top:10px; }
input, select { width:100%; padding:8px; margin-top:5px; }
input[type=submit]{ margin-top:15px; background:#27ae60; color:#fff; border:none; cursor:pointer; }
input[type=submit]:hover{ background:#219150; }
</style>
</head>
<body>

<h2>Edit Customer #<?= htmlspecialchars($customer['id']) ?></h2>

<form method="post">
    <label>First Name:</label>
    <input type="text" name="firstname" value="<?= htmlspecialchars($customer['firstname']) ?>" required>
    
    <label>Last Name:</label>
    <input type="text" name="lastname" value="<?= htmlspecialchars($customer['lastname']) ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($customer['email']) ?>" required>

    <label>Mobile:</label>
    <input type="text" name="mobile" value="<?= htmlspecialchars($customer['mobile']) ?>" required>

    <label>Gender:</label>
    <select name="gender" required>
        <option value="Male" <?= $customer['gender']=='Male'?'selected':'' ?>>Male</option>
        <option value="Female" <?= $customer['gender']=='Female'?'selected':'' ?>>Female</option>
    </select>

    <input type="submit" name="submit" value="Update Customer">
</form>

</body>
</html>
