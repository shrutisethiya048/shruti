<?php
include("config.php");
// Initialize cart session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Function to count total items in cart
function cart_item_count() {
    $count = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $count += $item['item_quantity'];
        }
    }
    return $count;
}

// Add to Cart
if (isset($_GET['add'])) {
    $product_id = intval($_GET['add']);
    $sql = "SELECT * FROM products WHERE id='$product_id'";
    $res = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($res);

    if ($product) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['item_quantity'] += 1;
        } else {
            $_SESSION['cart'][$product_id] = [
                'item_name' => $product['name'],
                'item_price' => $product['price'],
                'item_quantity' => 1,
                'item_image' => $product['image']
            ];
        }
    }
    header("Location: shop.php"); // Redirect after adding
    exit();
}

// Fetch categories
$cat_sql = "SELECT DISTINCT category FROM products ORDER BY category ASC";
$cat_result = mysqli_query($conn, $cat_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Shop - Beauty Shop</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
body { background: #f9f9f9; }
.product-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    margin-bottom: 20px;
    background: #fff;
    transition: 0.3s;
}
.product-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
.product-card img {
    width: 180px;
    height: 180px;
    object-fit: cover;
    margin-bottom: 10px;
}
</style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Our Products</h1>

    <!-- View Cart Button with Item Count -->
    <div class="text-end mb-3">
        <a href="cart.php" class="btn btn-primary">
            🛒 View Cart 
            <?php $count = cart_item_count(); if($count > 0) { echo "($count)"; } ?>
        </a>
    </div>

    <!-- Product Accordion -->
    <div class="accordion" id="productAccordion">
    <?php
    $i = 1;
    while ($cat_row = mysqli_fetch_assoc($cat_result)) {
        $category = $cat_row['category'];
        $prod_sql = "SELECT * FROM products WHERE category='$category'";
        $prod_result = mysqli_query($conn, $prod_sql);

        if (mysqli_num_rows($prod_result) > 0) {
    ?>
    <div class="card">
        <div class="card-header" id="heading<?= $i ?>">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i ?>" aria-expanded="<?= ($i==1)?'true':'false' ?>" aria-controls="collapse<?= $i ?>">
                    <?= $category ?>
                </button>
            </h2>
        </div>

        <div id="collapse<?= $i ?>" class="collapse <?= ($i==1)?'show':'' ?>" aria-labelledby="heading<?= $i ?>" data-bs-parent="#productAccordion">
            <div class="card-body">
                <div class="row">
                <?php while ($product = mysqli_fetch_assoc($prod_result)) { ?>
                    <div class="col-md-3">
                        <div class="product-card">
                            <img src="assets/images/products/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                            <h5><?= $product['name'] ?></h5>
                            <p>₹<?= $product['price'] ?></p>
                            <a href="detail.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-primary mb-1">View</a>
                            <a href="shop?add=<?= $product['id'] ?>" class="btn btn-sm btn-success">Add to Cart</a>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php $i++; } } ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
