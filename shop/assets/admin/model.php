<?php
class model {
    public $conn;

    // Constructor - Database connection
    function __construct() {
        $this->conn = new mysqli('localhost','root','','admin_panel');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Fetch all products
    function select($tbl) {
        $sel = "SELECT id, name, description, price, image FROM products";
        $run = $this->conn->query($sel);

        $arr = [];
        while($fetch = $run->fetch_object()) {
            $arr[] = $fetch;
        }
        return $arr;
    }
	// fetch delete
	function delete_where($tbl,$where){
		$del="delete from $tbl where 1=1";
		$array_key=array_keys($where);
		$array_value=array_values($where);
		$i=0;
		foreach($where as $w)
		{
		$del .= " AND " . $array_key[$i] . " = '" . $array_value[$i] . "' ";
			$i++;
		}
		$run=$this->conn->query($del);
		return $run;
	}
	function update(){
	}
	
	
	
	
    // Fetch all orders
    function fetchOrders() {
        $sel = "SELECT order_id, customer_name, product_name, quantity, price, status, created_at FROM orders";
        $run = $this->conn->query($sel);

        $arr = [];
        while($fetch = $run->fetch_object()) {
            $arr[] = $fetch;
        }
        return $arr;
    }

    // Fetch all customers
    function fetchCustomers() {
        $sel = "SELECT id, firstname, lastname, email, mobile, gender, lag, image FROM customer";
        $run = $this->conn->query($sel);

        $arr = [];
        while($fetch = $run->fetch_object()) {
            $arr[] = $fetch;
        }
        return $arr;
    }

    // Fetch all users
    function fetchUsers() {
        $sel = "SELECT id, name, email, mobile, password FROM users";
        $run = $this->conn->query($sel);

        if(!$run) {
            die("Query failed: " . $this->conn->error); // Error check
        }

        $arr = [];
        while($fetch = $run->fetch_object()) {
            $arr[] = $fetch;
        }
        return $arr;
    }
	// fetch Admin profile
	function fetchAdmin($username) {
    $sql = "SELECT * FROM admin WHERE username='$username' LIMIT 1";
    $res = mysqli_query($this->conn, $sql);
    return mysqli_fetch_assoc($res);
}
    // Insert data into any table
    function insert($tbl, $arr) {
        $array_key = array_keys($arr);
        $col = implode(",", $array_key);

        $array_value = array_values($arr);
        $values = implode("','", $array_value);

        $ins = "INSERT INTO $tbl($col) VALUES('$values')";
        $run = $this->conn->query($ins);
        return $run;
    }
} // End of class

$obj = new model();
?>
