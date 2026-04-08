<?php session_start();?>
<!Doctype html>
<html>
<head>
<title>Add Ticket</title>
<script>
    function validateForm(){
let title =document.forms["ticketForm"]["title"].value;
if(title ==""){
alert("title required");
return false;
    }
    }
</script>
</head>
<body>
<h2>Create Ticket</h2>
<form name="ticketForm" action="save_ticket.php"method="post"onsubmit="return validateForm()">
Title:<input type="text" name="title"><br><br>
Assign To:<input type="text"name="assigned_to"><br><br>
<button type="submit">submit</button>
</form>
</body>
</html>