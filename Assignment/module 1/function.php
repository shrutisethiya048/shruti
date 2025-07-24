<?php
	$a=5;
	function table ($a=0)
	{
	for($i=1;$i<=10;$i++)
	{
	   echo $a."*".$i."=".$a*$i. "<br>";
	}
	}
	table(5);echo"<br>";
	table(15);echo"<br>";
	table(45);
?>