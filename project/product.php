<?php
include("config.php");

// fetch products
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Products</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <div class="row">

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="col-md-3 mb-4">
        <div class="card h-100">
          <img src="img/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>" style="height:200px; object-fit:cover;">
          <div class="card-body text-center">
            <h5 class="card-title"><?php echo $row['name']; ?></h5>
            <p class="card-text">₹<?php echo $row['price']; ?></p>

            <!-- ✅ View Button -->
            <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>

            <!-- ✅ Add to Cart -->
            <form action="add_to_cart.php" method="post" class="d-inline">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
              <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
              <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
              <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
              <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
            </form>
          </div>
        </div>
      </div>
    <?php } ?>

  </div>
</div>

</body>
</html>
