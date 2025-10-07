<?php
include_once("model.php");
$obj = new model();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $res = $obj->delete_where("orders", ["order_id" => $id]);
    if($res) {
        echo "<script>
        alert('Order deleted successfully');
        window.location='orders.php';
        </script>";
    } else {
        echo "<script>
        alert('Failed to delete order');
        window.location='orders.php';
        </script>";
    }
} else {
    header("Location: orders.php");
    exit;
}
?>
