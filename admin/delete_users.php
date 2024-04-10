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
mysqli_query($db,"DELETE FROM users WHERE u_id = '".$_GET['user_del']."'");
header("location:allusers.php");  

?>
