<?php
session_start();
$_SESSION["username"]="shruti";
echo"session started.username is set to shruti.";
?>
<br><a href="show_session.php">show session Data</a>