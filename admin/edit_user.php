<?php
session_start();
include_once("model.php");
$obj = new model();

// Session check
if(!isset($_SESSION['a_id'])){
    header("Location: admin_login.php");
    exit;
}

// Get user ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($id <= 0){
    echo "<script>alert('Invalid User ID'); window.location='users.php';</script>";
    exit;
}

// Fetch user from database
$userResult = $obj->select_where("users", ["id"=>$id]);
if($userResult && $userResult->num_rows > 0){
    $user = $userResult->fetch_assoc();
} else {
    echo "<script>alert('User not found'); window.location='users.php';</script>";
    exit;
}

// Update user
if(isset($_POST['submit'])){
    $updateData = [
        "name"   => $_POST['name'],
        "email"  => $_POST['email'],
        "mobile" => $_POST['mobile']
    ];

    // Handle image upload if file selected
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
        $img_name = time().'_'.$_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $upload_dir = "assets/images/users/";
        move_uploaded_file($tmp_name, $upload_dir.$img_name);
        $updateData['image'] = $img_name;

        // Optionally delete old image
        if(!empty($user['image']) && file_exists($upload_dir.$user['image'])){
            unlink($upload_dir.$user['image']);
        }
    }

    $obj->update("users", $updateData, ["id"=>$id]);

    echo "<script>
        alert('User updated successfully'); 
        window.location='users.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit User</title>
<style>
body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
h2 { margin-bottom: 20px; }
form { background: #fff; padding: 20px; border-radius: 8px; max-width: 500px; }
label { display:block; margin-top:10px; }
input, select { width:100%; padding:8px; margin-top:5px; }
input[type=submit]{ margin-top:15px; background:#007bff; color:#fff; border:none; cursor:pointer; }
input[type=submit]:hover{ background:#0056b3; }
img { margin-top:10px; border-radius:5px; width:100px; }
</style>
</head>
<body>

<h2>Edit User #<?= htmlspecialchars($user['id']) ?></h2>

<form method="post" enctype="multipart/form-data">
    <label>Full Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

    <label>Mobile:</label>
    <input type="text" name="mobile" value="<?= htmlspecialchars($user['mobile']) ?>" required>

    <label>Profile Image:</label>
    <?php if(!empty($user['image']) && file_exists("assets/images/user/".$user['image'])): ?>
        <img src="assets/images/user/<?= $user['image'] ?>" alt="User Image">
    <?php else: ?>
        <p>No image uploaded.</p>
    <?php endif; ?>
    <input type="file" name="image" accept="image/*">

    <input type="submit" name="submit" value="Update User">
</form>

</body>
</html>
