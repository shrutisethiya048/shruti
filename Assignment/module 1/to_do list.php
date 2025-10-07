<?php
session_start();
if (!isset($_SESSION['tasks'])) {
$_SESSION['tasks'] =[];
}
if (isset($_POST['add'])) {
$task =trim($_POST['task']);
if (!empty($task)) {
$_SESSION['tasks'][] =$task;
}
}
if (isset($_POST['delete'])) {
    $index = $_POST['delete'];
    unset($_SESSION['tasks'][$index]);
    $_SESSION['tasks'] = array_values($_SESSION['tasks']); // re-index
}
?>
<html>
<head>
  <title>To-Do List</title>
  <style>
    body { font-family: Arial; background: #f0f8ff; padding: 30px; }
    h2 { color: #4a148c; }
    form { margin-bottom: 20px; }
    input[type="text"] { padding: 8px; width: 250px; }
    button { padding: 8px 15px; margin-left: 5px; }
    li { margin: 8px 0; }
  </style>
</head>
<body>

<h2> Shruti's To-Do List</h2>

<form method="post">
  <input type="text" name="task" placeholder="Enter your task">
  <button type="submit" name="add">Add Task</button>
</form>

<ul>
<?php foreach ($_SESSION['tasks'] as $index => $task): ?>
  <li>
    <?= htmlspecialchars($task) ?>
    <form method="post" style="display:inline;">
      <button type="submit" name="delete" value="<?= $index ?>"></button>
    </form>
  </li>
<?php endforeach; ?>
</ul>

</body>
</html>
 