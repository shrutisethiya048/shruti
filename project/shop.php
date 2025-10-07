<?php
include("config.php");

// Fetch unique categories
$cat_sql = "SELECT DISTINCT category FROM products ORDER BY category ASC";
$cat_result = mysqli_query($conn, $cat_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shop - Beauty Shop</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .product-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        text-align: center;
        margin-bottom: 20px;
    }
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

  <div class="accordion" id="productAccordion">

    <?php 
    $i = 1;
    while($cat_row = mysqli_fetch_assoc($cat_result)) { 
        $category = $cat_row['category'];
        $prod_sql = "SELECT * FROM products WHERE category='$category'";
        $prod_result = mysqli_query($conn, $prod_sql);
        
        if(mysqli_num_rows($prod_result) > 0) {
    ?>
    
    <div class="card">
      <div class="card-header" id="heading<?php echo $i; ?>">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
            <?php echo $category; ?>
          </button>
        </h2>
      </div>

      <div id="collapse<?php echo $i; ?>" class="collapse <?php echo ($i==1)?'show':''; ?>" aria-labelledby="heading<?php echo $i; ?>" data-parent="#productAccordion">
        <div class="card-body">
          <div class="row">
            <?php while($product = mysqli_fetch_assoc($prod_result)) { ?>
              <div class="col-md-3">
                <div class="product-card">
                  <img src="img/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                  <h5><?php echo $product['name']; ?></h5>
                  <p>₹<?php echo $product['price']; ?></p>
                  <a href="detail.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-primary">View</a>
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
</body>
</html>
