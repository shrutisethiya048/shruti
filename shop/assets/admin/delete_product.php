<?php
include('db_connection.php');
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM products WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: products.php?status=success");
    } else {
        header("Location: products.php?status=error");
    }
} else {
    header("Location: products.php?status=invalid");
}
exit();
?>
