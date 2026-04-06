<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id       = $_GET['id'];                 
    $name     = $_POST['hidden_name'];       
    $price    = $_POST['hidden_price'];      
    $quantity = (int)$_POST['quantity'];
    $image    = $_POST['hidden_image'];  //  Added line for image

    //  Initialize cart if not exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    //  Add or update item
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['item_quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$id] = [
            'item_name'     => $name,
            'item_price'    => $price,
            'item_quantity' => $quantity,
            'item_image'    => $image
        ];
    }

    //  Redirect back to cart page
    header("Location: cart.php");
    exit;
}
?>
<?php include("footer.php"); ?>
