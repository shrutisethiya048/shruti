<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

$data = json_decode(file_get_contents("php://input"), true);
$email = $data["email"];
$password = $data["password"];

require_once "dbconfig.php";

$query = "SELECT * FROM user WHERE email='$email'and password='$password'";

$result = mysqli_query($conn, $query) or die("Search Query Failed.");

$count = mysqli_num_rows($result);

if($count > 0)
{	
	echo json_encode(array("message" => "Login Success.", "status" => true));
}
else
{	
	
	echo json_encode(array("message" => "Login Failed.", "status" => false));
}

?>