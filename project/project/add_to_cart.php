<?php
session_start();

if (isset($_GET['id'], $_GET['name'], $_GET['price'], $_GET['image'])) {
    $id = $_GET['id'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['item_quantity']++;
    } else {
        $_SESSION['cart'][$id] = [
            'item_id'       => $id,
            'item_name'     => $_GET['name'],
            'item_price'    => $_GET['price'],
            'item_image'    => $_GET['image'],
            'item_quantity' => 1
        ];
    }
}

header("Location: cart.php");
exit();
?>
