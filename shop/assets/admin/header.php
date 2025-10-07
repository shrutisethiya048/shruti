<?php

include_once("model.php"); // database/model file

if (isset($_SESSION['a-id'])) {
    echo "<script>window.location='dashboard.php';</script>";
    exit;
}

if (isset($_REQUEST['submit'])) {
    $name = $_REQUEST['name'];
    $password = $_REQUEST['password'];

    $where = array("name" => $name, "password" => md5($password));

    // Query run
    $run = $this->select_where('admin', $where);

    if ($run && $run->num_rows > 0) {
        $fetch = $run->fetch_object();

        $_SESSION['a-id'] = $fetch->id;
        $_SESSION['a-name'] = $fetch->name;
        $_SESSION['a-password'] = $fetch->password;

        echo "<script>
            alert('Login Success');
            window.location='dashboard.php';  //  direct dashboard.php
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Login failed due to wrong credentials');
            window.location='admin-login.php';  //  correct login page
        </script>";
        exit;
    }
}
?>
