<?php
include 'db.php';
//quary to fetch all customers
$sel="SELECT *FROM customers";
$res =$conn->query($sel);
$arr =[];
while($fetch =$res->fetch_object()) {
$arr[] =$fetch;
}
if(empty($arr)) {
echo json_encode(["message"=> "No customer found"]);
}else{
echo json_encode($arr);
}
?>
