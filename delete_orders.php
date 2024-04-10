<?php
session_start();
include("connection/connect.php"); //connection to db
error_reporting(0);


// sending query
mysqli_query($db,"DELETE FROM users_orders WHERE o_id = '".$_GET['order_del']."'"); // deletig records on the bases of ID
header("location:your_orders.php");  //once deleted success redireted back to current page

?>
