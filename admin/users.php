<?php
include_once("model.php");    
$obj = new model();

// Fetch all users
$users = $obj->fetchUsers();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f9f9f9; }
        h2 { margin-bottom: 20px; }
        table { border-collapse: collapse; width: 100%; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #007bff; color: #fff; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        a { text-decoration: none; padding: 5px 10px; border-radius: 3px; color: #fff; font-size: 14px; }
        .button.edit { background: #28a745; }    /* green */
        .button.delete { background: #dc3545; }  /* red */
        .button.block { background: #dc3545; }   /* red */
        .button.unblock { background: #28a745; } /* green */
        img { width: 80px; height: 80px; border-radius: 5px; object-fit: cover; }
        td img { display: block; margin: 0 auto; }
    </style>
</head>
<body>

<h2>Manage Users</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Status</th>
        <th>Image</th>
        <th>Action</th>
    </tr>

    <?php if(!empty($users)) { 
        foreach($users as $user) { 
            $status = isset($user->status) ? $user->status : 'Unblock';
    ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= htmlspecialchars($user->name ?? '') ?></td>
            <td><?= htmlspecialchars($user->email ?? '') ?></td>
            <td><?= htmlspecialchars($user->mobile ?? '') ?></td>
            <td><?= $status ?></td>
            <td>
                <?php if(!empty($user->image) && file_exists("assets/images/user/".$user->image)) { ?>
                    <img src="assets/images/user/<?= htmlspecialchars($user->image) ?>" alt="<?= htmlspecialchars($user->name ?? '') ?>">
                <?php } else { ?>
                    No Image
                <?php } ?>
            </td>
            <td>
                <a href="edit_user.php?id=<?= $user->id ?>" class="button edit">Edit</a>
                <a href="delete_user.php?id=<?= $user->id ?>" onclick="return confirm('Are you sure?')" class="button delete">Delete</a>
                
                <?php if($status == 'Block') { ?>
                    <a href="control.php/status_user?status_user=<?= $user->id ?>" 
                       class="button unblock">Unblock</a>
                <?php } else { ?>
                    <a href="control.php/status_user?status_user=<?= $user->id ?>" 
                       class="button block">Block</a>
                <?php } ?>
            </td>
        </tr>
    <?php } 
    } else { ?>
        <tr><td colspan="7" style="text-align:center;">No users found.</td></tr>
    <?php } ?>
</table>

</body>
</html>
