<?php
require_once "Database.php";

$db = new Database();  // Create object

$query = "SELECT * FROM users";
$users = $db->getData($query);

echo "<h2>User List</h2>";
echo "<table border='1' cellpadding='8'>
        <tr><th>ID</th><th>Name</th><th>Email</th></tr>";

if (!empty($users)) {
    foreach ($users as $user) {
        echo "<tr>
                <td>{$user['id']}</td>
                <td>{$user['name']}</td>
                <td>{$user['email']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No users found</td></tr>";
}

echo "</table>";
?>
