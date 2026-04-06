<?php
session_start();
if(!isset($_SESSION['user'])){
header("Location: login.php");
}
?>
<h2>Welcome <?php echo $_SESSION['user']; ?></h2>
<a href="ticket.php">Create Ticket</a><br><br>
<button onclick="loadTickets()">View Tickets</button>
<div id="tickets"></div>
<script src="js/script.js"></script>