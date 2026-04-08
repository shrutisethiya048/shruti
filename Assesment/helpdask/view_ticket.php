<?php
$file = 'tickets.json';
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Tickets</title>
</head>
<body>

<h2>All Tickets</h2>

<!-- Buttons OUTSIDE PHP -->
<button onclick="loadData('Open')">Open Tickets</button>
<button onclick="loadData('Closed')">Closed Tickets</button>

<div id="result"></div>

<hr>

<?php
foreach($data as $ticket) {
    echo "<b>ID:</b> " . $ticket['id'] . "<br>";
    echo "<b>Title:</b> " . $ticket['title'] . "<br>";
    echo "<b>Status:</b> " . $ticket['status'] . "<br>";
    echo "<b>Assigned To:</b> " . $ticket['assigned_to'] . "<br>";
    echo "<b>Date:</b> " . $ticket['date'] . "<br>";
    echo "<hr>";
}
?>

<!-- AJAX Script -->
<script>
function loadData(status){
    let xhr = new XMLHttpRequest();

    xhr.open("GET", "fetch_ticket.php?status=" + status, true);

    xhr.onload = function(){
        document.getElementById("result").innerHTML = this.responseText;
    }

    xhr.send();
}
</script>

</body>
</html>