<?php
$status = $_GET['status'] ?? '';

$file = 'tickets.json';
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

foreach($data as $ticket) {
    if($status == '' || $ticket['status'] == $status){

        echo "<div style='border:1px solid gray; padding:10px; margin:10px'>";
        echo "<b>".$ticket['title']."</b><br>";
        echo "Status: ".$ticket['status']."<br>";

        // Status change button
        if($ticket['status'] == "Open"){
    echo "<a href='update_status.php?id=".$ticket['id']."'>Make as Closed</a>";
}
        echo "</div>";
    }
}
?>