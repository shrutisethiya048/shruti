<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Registration Form</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
function getstate(cid)
{
	if(window.XMLHttpRequest)
	{
		xmlhttp= new XMLHttpRequest();	
	}
	else
	{
		xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");	
	}
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("sid").innerHTML=xmlhttp.responseText;	
		}
	}
xmlhttp.open("GET","statedata?btn=" + cid,true);
xmlhttp.send();
}



function getcity(sid)
{
	$.ajax
	({
		type: "POST",
		url: "citydata",
		data:"btn=" + sid,
		success: function(data)
		{
			$("#city_id").html(data) ;
		}
	});
}
</script>
</head>

<body>
<a href="control.php?page=show">Show All Data</a>

<form action="" method="post">
<table border="1" align="center" cellpadding="10">
<caption><b>REGISTRATION FORM</b></caption>

<tr>
<td>User Name</td>
<td><input type="text" name="name" required></td>
</tr>

<tr>
<td>Country</td>
<td>
<select name="cid" id="cid" onchange="getstate(this.value)" required>
<option>---- Select Country ----</option>
<?php
foreach($country_arr as $f)
{
?>
    <option value="<?php echo $f->id; ?>">
        <?php echo $f->country_name; ?>
    </option>
<?php
}
?>
</select>
</td>
</tr>

<tr>
<td>State</td>
<td>
<select id="sid" name="sid" onchange="getcity(this.value)"required>
    <option value="">---- Select State ----</option>
</select>
</td>
</tr>

<tr>
<td>City</td>
<td>
<select id="city_id" name="city_id" required>
    <option value="">---- Select City ----</option>
</select>
</td>
</tr>

<tr>
<td colspan="2" align="center">
    <input type="submit" name="submit" value="Insert">
</td>
</tr>

</table>
</form>
</body>
</html>
