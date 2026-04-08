<?php
$title = $_POST['title'];
$assigned_to = $_POST['assigned_to'];

$file = 'tickets.json';

$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$id = count($data) + 1;

$ticket = [
    "id" => $id,
    "title" => $title,
    "status" => "Open",
    "assigned_to" => $assigned_to,
    "date" => date("Y-m-d")
];

$data[] = $ticket;

file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

header("Location: dashboard.php");
exit();
?>