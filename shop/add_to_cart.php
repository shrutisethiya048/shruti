<?php
if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id       = $_GET['id'];                 
    $name     = $_POST['hidden_name'];       
    $price    = $_POST['hidden_price'];      
    $quantity = (int)$_POST['quantity'];    
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['item_quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$id] = array(
            'item_name'     => $name,
            'item_price'    => $price,
            'item_quantity' => $quantity,
            'item_image'    => $image
        );
    }

    header("Location: cart");
    exit;
}
?>
