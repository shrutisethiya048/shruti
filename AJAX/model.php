<?php
class model
{
	public $conn="";
	
	function __construct()
	{
		$this->conn = new mysqli('localhost','root','','ajax');
	}
	
	function insert($tbl,$data)
	{
		$key_arr = array_keys($data);
		$col = implode(",",$key_arr);
		$value_arr = array_values($data);
		$value = implode("','",$value_arr);
		
		$ins = "INSERT INTO $tbl($col) VALUES('$value')";
		$run = $this->conn->query($ins);
		
		return $run;
	}
	function select($tbl)
	{
		$sel = "SELECT * FROM $tbl";
		$run = $this->conn->query($sel);
		while($fetch = $run->fetch_object())
		{
			$arr[] = $fetch;
		}
		if(!empty($arr))
		{
			return $arr;
		}
	}

	function selectSearch($tbl1,$tbl2,$on1,$tbl3,$on2,$tbl4,$on3,$col,$value)
	{
		$sel = "SELECT * FROM $tbl1 
				JOIN $tbl2 ON $on1 
				JOIN $tbl3 ON $on2 
				JOIN $tbl4 ON $on3 
				WHERE $col LIKE '$value%'";
		$run = $this->conn->query($sel);
		while($fetch = $run->fetch_object())
		{
			$arr[] = $fetch;
		}
		if(!empty($arr))
		{
			return $arr;
		}
	}

	function select_where($tbl,$where)
	{
		$sel = "SELECT * FROM $tbl WHERE 1=1";
		$i=0;
		$col = array_keys($where);
		$value = array_values($where);
		foreach($where as $w)
		{
			$sel.= " AND $col[$i]='$value[$i]'";
			$i++;
		}
		$run = $this->conn->query($sel);
		$arr=[];
		while($fetch=$run->fetch_object())
		{
			$arr[]=$fetch;
		}
		if(!empty($arr))
		{
			return $arr;
		}
	}

	function select_join4($tbl1,$tbl2,$on1,$tbl3,$on2,$tbl4,$on3)
	{
		$sel = "SELECT * FROM $tbl1 
				JOIN $tbl2 ON $on1 
				JOIN $tbl3 ON $on2 
				JOIN $tbl4 ON $on3";
		$run = $this->conn->query($sel);
		while($fetch = $run->fetch_object())
		{
			$arr[]=$fetch;
		}
		if(!empty($arr))
		{
			return $arr;
		}
	}

	function select_orderby($tbl1,$col)
	{
		$sel = "SELECT * FROM $tbl1 ORDER BY $col";
		$run = $this->conn->query($sel);
		while($fetch = $run->fetch_object())
		{
			$arr[]=$fetch;
		}
		if(!empty($arr))
		{
			return $arr;
		}
	}
}

$obj = new model;
?>
