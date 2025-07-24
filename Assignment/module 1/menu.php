
<html>
<head>
    <title>Restaurant Menu</title>
</head>
<body>
    <h2>Select Food Category</h2>
    <form method="post">
        <input type="submit" name="choice" value="1"> Starter<br><br>
        <input type="submit" name="choice" value="2"> Main Course<br><br>
        <input type="submit" name="choice" value="3"> Dessert<br><br>
    </form>

    <?php
    if (isset($_POST['choice'])) {
        $choice = $_POST['choice'];

        switch ($choice) {
            case 1:
                echo "<h3>Category: Starter</h3>";
				echo"Dish: Spring Rolls <br>";
				echo"price:120rs";
                break;           
            case 2:
                echo "<h3>Category: Main Course</h3>";
                echo "Dish: Veg Biryani with Raita <br>";
				echo"price:250rs";
                break;
            case 3:
                echo "<h3>Category: Dessert</h3>";
                echo "Dish: Ice Cream <br>";
				echo "price:80rs";
                break;
            default:
                echo "Invalid selection.";
        }
    }
    ?>
</body>
</html>
