<?php
if (isset($_COOKIE["username"])) {
    echo "<h3> Welcome back, " . $_COOKIE["username"] . "!</h3>";
} else {
    echo "<h3 style='color:red;'> Alert! Username cookie missing or expired.</h3>";
}
?>
<br><a href="delete_cookie.php">Delete Cookie</a>
