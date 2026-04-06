<?php
include("config.php");

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

if(!$result){
    die("Query Failed: " . mysqli_error($conn));
}

$total_items = 0;
if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $item){
        $total_items += $item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Beauty Shop</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">Beauty Shop</a>
  <a href="cart.php" class="btn btn-primary">
    Cart (<?php echo $total_items; ?>)
  </a>
</nav>

<div class="container mt-4">
  <div class="row">

    <?php if(mysqli_num_rows($result) > 0){ ?>
      <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <div class="col-md-4 mb-4">
          <div class="card">
            <img src="img/<?php echo $row['image']; ?>" 
                 class="card-img-top" 
                 style="height:200px; object-fit:cover;">

            <div class="card-body text-center">
              <h5><?php echo $row['product_name']; ?></h5>
              <p>₹<?php echo $row['price']; ?></p>

              <form action="add_to_cart.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="name" value="<?php echo $row['product_name']; ?>">
                <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-success btn-sm">
                  Add to Cart
                </button>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } else { ?>
      <div class="col-12 text-center">
        <h4>No Products Found</h4>
      </div>
    <?php } ?>

  </div>
</div>

</body>
</html>