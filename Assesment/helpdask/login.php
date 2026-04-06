<?php
session_start();
if(isset($_POST['login'])){
$username =$_POST['username'];
$username =$_POST['password'];
if($username=="admin" && $password=="1234"){
$_SESSION['username=="admin" && $password=="1234") {
$_SESSION['user']=$username;
header("Location: dashboard.php");
}else{
echo"Invalid Login";
}
}
?>
<form method="post">
username:
<input type="text" name="username"><br><br>
password:
<input type="password" name="password"><br><br>
<button name="login">Login</button>
</form>