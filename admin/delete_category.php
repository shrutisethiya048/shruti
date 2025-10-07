<?php


include('db_connection.php');

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $check = mysqli_query($conn, "SELECT * FROM `categories` WHERE `id`=$id");
    if(mysqli_num_rows($check) > 0){
        $delete = mysqli_query($conn, "DELETE FROM `categories` WHERE `id`=$id");
        if($delete){
            header("Location: categories.php");
            exit();
        } else {
            die("Error deleting category: " . mysqli_error($conn));
        }
    } else {
        die("Category not found!");
    }
} else {
    die("Invalid Category ID!");
}
?>
