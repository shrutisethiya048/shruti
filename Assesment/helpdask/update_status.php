<?php
$id = $_GET['id'];

$file = 'tickets.json';
$data = json_decode(file_get_contents($file), true);

foreach($data as &$ticket){
    if($ticket['id'] == $id){

        // STATUS CHANGE
        if($ticket['status'] == "Open"){
            $ticket['status'] = "Closed";
        } else {
            $ticket['status'] = "Open";
        }
    }
}

// save updated data
file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

// redirect
header("Location: dashboard.php");
exit();
?>