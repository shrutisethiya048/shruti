<?php
setcookie("username", "", time() - 3600);
echo "<h3> Cookie removed. You can now set it again.</h3>";
?>
<br><a href="set_cookie.php">Set Cookie Again</a>
