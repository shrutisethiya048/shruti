<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        h2 { margin-bottom: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        a { text-decoration: none; padding: 5px 10px; border-radius: 3px; margin-right: 5px; }
        .edit { background-color: #f0f0f0; }
        .delete { background-color: #ffdddd; }
    </style>
</head>
<body>
    <h2>All Users</h2>
<table>
    <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Actions</th>
    </tr>
    <?php if(!empty($users_arr)) { 
        foreach($users_arr as $user) { ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= $user->name ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->mobile ?></td>
                <td>
                    <a class="edit" href="edit_user.php?id=<?= $user->id ?>">Edit</a>
                    <a class="delete" href="users.php?delete_id=<?= $user->id ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
    <?php } 
    } else { ?>
        <tr><td colspan="5">No users found</td></tr>
    <?php } ?>
</table>
