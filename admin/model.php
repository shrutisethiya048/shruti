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
        $sel = "SELECT * FROM $tbl";
        $run = $this->conn->query($sel);

        $arr = [];
        while($fetch = $run->fetch_object()) {
            $arr[] = $fetch;
        }
        return $arr;
    }

    // Fetch with WHERE condition
    function select_where($tbl, $where) {
        $sel = "SELECT * FROM $tbl WHERE 1=1";
        foreach ($where as $key => $value) {
            $sel .= " AND $key = '" . $this->conn->real_escape_string($value) . "'";
        }
        $run = $this->conn->query($sel);
        return $run;
    }

    // Delete record with WHERE
    function delete_where($tbl, $where){
        $del = "DELETE FROM $tbl WHERE 1=1";
        foreach ($where as $key => $value) {
            $del .= " AND $key = '" . $this->conn->real_escape_string($value) . "'";
        }
        $run = $this->conn->query($del);
        return $run;
    }

    // Update record with WHERE
    function update($tbl, $arr, $where) {
        $set = [];
        foreach ($arr as $key => $value) {
            $set[] = "$key='" . $this->conn->real_escape_string($value) . "'";
        }
        $setStr = implode(",", $set);

        $whereStr = [];
        foreach ($where as $key => $value) {
            $whereStr[] = "$key='" . $this->conn->real_escape_string($value) . "'";
        }
        $whereStr = implode(" AND ", $whereStr);

        $upd = "UPDATE $tbl SET $setStr WHERE $whereStr";
        $run = $this->conn->query($upd);
        return $run;
    }

    // Count rows function
    function countRows($table) {
        $sql = "SELECT COUNT(*) as total FROM $table";
        $res = $this->conn->query($sql);
        $row = $res->fetch_assoc();
        return $row['total'];
    }
	
    // Fetch all orders with customer + products + items
          function fetchOrders() {
           $sql = "SELECT 
                order_id, 
                customer_name,
                product_name,
                quantity,
                price,
                status,
                shipping_address,
                billing_address,
                created_at
            FROM orders
            ORDER BY order_id DESC";

    $res = $this->conn->query($sql);

    if(!$res) {
        die('Query Failed: ' . $this->conn->error);
    }

    $arr = [];
    while($row = $res->fetch_object()) {
        $arr[] = $row;
    }
    return $arr;
}

    // Fetch all customers
    function fetchCustomers() {
        $sel = "SELECT * FROM customer";
        $run = $this->conn->query($sel);

        $arr = [];
        while($fetch = $run->fetch_object()) {
            $arr[] = $fetch;
        }
        return $arr;
    }

    // Fetch all users
    function fetchUsers() {
        $sel = "SELECT * FROM users";
        $run = $this->conn->query($sel);

        if(!$run) {
            die("Query failed: " . $this->conn->error);
        }

        $arr = [];
        while($fetch = $run->fetch_object()) {
            $arr[] = $fetch;
        }
        return $arr;
    }

    // Fetch Admin profile
    function fetchAdmin($username) {
        $sql = "SELECT * FROM admin WHERE username='".$this->conn->real_escape_string($username)."' LIMIT 1";
        $res = $this->conn->query($sql);
        return $res->fetch_assoc();
    }

    // Insert data into any table
    function insert($tbl, $arr) {
        $array_key = array_keys($arr);
        $col = implode(",", $array_key);

        $array_value = array_values($arr);
        $values = implode("','", array_map([$this->conn, 'real_escape_string'], $array_value));

        $ins = "INSERT INTO $tbl($col) VALUES('$values')";
        $run = $this->conn->query($ins);
        return $run;
    }
}

// Initialize model
$obj = new model();
?>
