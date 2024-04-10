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
mysqli_query($db,"DELETE FROM res_category WHERE c_id = '".$_GET['cat_del']."'");
header("location:add_category.php");  

?>
