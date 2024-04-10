<?php
session_start();
include("../connection/connect.php");
error_reporting(0);

if (!isset($_SESSION['adm_id'])) {
    // Redirect to login page
    header("Location: index.php");
    exit();
}


// sending query
mysqli_query($db,"DELETE FROM users_orders WHERE o_id = '".$_GET['order_del']."'");
header("location:all_orders.php");  

?>
