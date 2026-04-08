
<?php
session_start();

// Login check
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px;
        }

        .box {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 450px;
            margin: auto;
            text-align: center;
            box-shadow: 0px 0px 10px gray;
        }

        a, button {
            display: block;
            margin: 10px;
            padding: 10px;
            text-decoration: none;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        a:hover, button:hover {
            background: #0056b3;
        }

        .filters button {
            display: inline-block;
            width: auto;
            margin: 5px;
        }

        #result {
            margin-top: 15px;
            text-align: left;
        }

        .ticket {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            background: #fafafa;
        }
    </style>
</head>

<body>

<div class="box">
    <h2>Welcome <?php echo $_SESSION['user']; ?></h2>

    <!-- Create Ticket -->
    <a href="ticket.php">➕ Create Ticket</a>

    <!-- View All -->
    <button onclick="loadData('')">📄 View Tickets</button>

    <!-- FILTER -->
    <div class="filters">
        <button onclick="loadData('')">All</button>
        <button onclick="loadData('Open')">Open</button>
        <button onclick="loadData('Closed')">Closed</button>
    </div>

    <!-- Logout -->
    <a href="logout.php">🚪 Logout</a>

    <!-- Result -->
    <div id="result"></div>
</div>

<!-- AJAX SCRIPT -->
<script>
function loadData(status){
    let xhr = new XMLHttpRequest();

    xhr.open("GET", "fetch_ticket.php?status=" + status, true);

    xhr.onload = function(){
        if(this.status == 200){
            document.getElementById("result").innerHTML = this.responseText;
        }
    }

    xhr.send();
}

// AUTO LOAD ALL TICKETS
window.onload = function(){
    loadData('');
}
</script>

</body>
</html>