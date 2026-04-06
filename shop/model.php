<?php
class model {

    public $conn;

    // DATABASE CONNECTION
    function __construct() {
        $this->conn = new mysqli("localhost","root","","admin_panel");

        if ($this->conn->connect_error) {
            die("Connection Failed: " . $this->conn->connect_error);
        }
    }

    // ==============================
    // SELECT ALL
    // ==============================
    function select($tbl) {

        $sql = "SELECT * FROM $tbl";
        $run = $this->conn->query($sql);

        if(!$run){
            die("Select Query Failed: " . $this->conn->error);
        }

        $arr = [];
        while($row = $run->fetch_object()){
            $arr[] = $row;
        }

        return $arr;
    }

    // ==============================
    // SELECT WITH WHERE
    // ==============================
    function select_where($tbl, $where){

        $sql = "SELECT * FROM $tbl WHERE 1=1";

        foreach($where as $key => $value){
            $value = $this->conn->real_escape_string($value);
            $sql .= " AND $key='$value'";
        }

        $run = $this->conn->query($sql);

        if(!$run){
            die("Select Where Failed: " . $this->conn->error);
        }

        return $run;
    }

    // ==============================
    // INSERT
    // ==============================
    function insert($tbl, $arr){

        $columns = implode(",", array_keys($arr));

        $values = [];
        foreach($arr as $value){
            $values[] = "'" . $this->conn->real_escape_string($value) . "'";
        }

        $values = implode(",", $values);

        $sql = "INSERT INTO $tbl($columns) VALUES($values)";

        $run = $this->conn->query($sql);

        if(!$run){
            die("Insert Failed: " . $this->conn->error);
        }

        return true;
    }

    // ==============================
    // UPDATE
    // ==============================
    function update($tbl, $arr, $where){

        $set = [];
        foreach($arr as $key => $value){
            $value = $this->conn->real_escape_string($value);
            $set[] = "$key='$value'";
        }

        $set = implode(",", $set);

        $whereArr = [];
        foreach($where as $key => $value){
            $value = $this->conn->real_escape_string($value);
            $whereArr[] = "$key='$value'";
        }

        $where = implode(" AND ", $whereArr);

        $sql = "UPDATE $tbl SET $set WHERE $where";

        $run = $this->conn->query($sql);

        if(!$run){
            die("Update Failed: " . $this->conn->error);
        }

        return true;
    }

    // ==============================
    // DELETE
    // ==============================
    function delete_where($tbl, $where){

        $sql = "DELETE FROM $tbl WHERE 1=1";

        foreach($where as $key => $value){
            $value = $this->conn->real_escape_string($value);
            $sql .= " AND $key='$value'";
        }

        $run = $this->conn->query($sql);

        if(!$run){
            die("Delete Failed: " . $this->conn->error);
        }

        return true;
    }

    // ==============================
    // COUNT ROWS
    // ==============================
    function countRows($tbl){

        $sql = "SELECT COUNT(*) as total FROM $tbl";
        $run = $this->conn->query($sql);

        if(!$run){
            die("Count Failed: " . $this->conn->error);
        }

        $row = $run->fetch_assoc();
        return $row['total'];
    }

}

// OBJECT CREATE
$obj = new model();
?>