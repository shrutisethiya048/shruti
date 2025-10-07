<!DOCTYPE html>
<html>
<head>
  <title>Beauty Products (Women)</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #fce4ec;
    }
    h2 {
      color: white;
      background-color: #8e44ad;
      padding: 15px;
      text-align: center;
      border-radius: 10px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #9c27b0;
      padding: 10px;
      text-align: left;
    }
    th {
      background-color: #f8bbd0;
    }
    img {
      width: 100px;
      height: auto;
    }
  </style>
</head>
<body>

<h2> Women's Clothing</h2>

<?php
$json = file_get_contents('https://fakestoreapi.com/products');
$phparr = json_decode($json);
?>

<table>
  <tr>
    <th>ID</th>
    <th>Title</th>
    <th>Price</th>
    <th>Description</th>
    <th>Category</th>
    <th>Image</th>
  </tr>

  <?php foreach ($phparr as $data) {
    if ($data->category == "women's clothing") {
  ?>
    <tr>
      <td><?= $data->id ?></td>
      <td><?= $data->title ?></td>
      <td>₹<?= rand(500, 2500) ?></td> <!-- Random price -->
      <td><?= substr($data->description, 0, 60) ?>...</td>
      <td><?= $data->category ?></td>
      <td><img src="<?= $data->image ?>" alt="Product Image"></td>
    </tr>
  <?php }} ?>
</table>

</body>
</html>
