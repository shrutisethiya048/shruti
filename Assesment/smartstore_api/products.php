<?php
header("Content-Type: application/json");
include "db.php";

$method = $_SERVER['REQUEST_METHOD'];
$headers = getallheaders();

//  API Methods
switch($method){

//  GET → Fetch all products
case "GET":
    $result = mysqli_query($conn, "SELECT * FROM products");

    if($result){
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($data);
        http_response_code(200);
    } else {
        echo json_encode(["error"=>"Failed to fetch data"]);
        http_response_code(500);
    }
break;
//  POST → Add product
case "POST":
    $input = json_decode(file_get_contents("php://input"), true);

    if(isset($input['name']) && isset($input['price'])){
        $name = $input['name'];
        $price = $input['price'];
        $desc = $input['description'];

        $query = "INSERT INTO products(name,price,description) VALUES('$name','$price','$desc')";
        
        if(mysqli_query($conn, $query)){
            echo json_encode(["message"=>"Product Added"]);
            http_response_code(201);
        } else {
            echo json_encode(["error"=>"Insert Failed"]);
            http_response_code(500);
        }
    } else {
        echo json_encode(["error"=>"Invalid Input"]);
        http_response_code(422);
    }
break;
// PUT → Update product
case "PUT":
    parse_str($_SERVER['QUERY_STRING'], $query);
    $id = $query['id'];

    $input = json_decode(file_get_contents("php://input"), true);

    if(isset($input['name']) && isset($input['price'])){
        $name = $input['name'];
        $price = $input['price'];

        $sql = "UPDATE products SET name='$name', price='$price' WHERE id=$id";

        if(mysqli_query($conn, $sql)){
            echo json_encode(["message"=>"Product Updated"]);
            http_response_code(200);
        } else {
            echo json_encode(["error"=>"Update Failed"]);
            http_response_code(500);
        }
    } else {
        echo json_encode(["error"=>"Invalid Input"]);
        http_response_code(422);
    }
break;


//  DELETE → Delete product
case "DELETE":
    parse_str($_SERVER['QUERY_STRING'], $query);
    $id = $query['id'];

    $sql = "DELETE FROM products WHERE id=$id";

    if(mysqli_query($conn, $sql)){
        echo json_encode(["message"=>"Product Deleted"]);
        http_response_code(200);
    } else {
        echo json_encode(["error"=>"Delete Failed"]);
        http_response_code(500);
    }
break;

}
?>