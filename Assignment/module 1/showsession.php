<?php
session_start(); 
if (isset($_SESSION["username"])) {
    echo "Welcome, " . $_SESSION["username"] . "!";
} else {
    echo "Session not set or expired.";
}
?>
<br><a href="destroy_session.php">Logout</a>
