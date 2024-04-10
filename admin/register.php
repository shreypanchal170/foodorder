<?php
session_start();
include("../connection/connect.php");
error_reporting(E_ALL);


$message = '';
$success = '';

if (isset($_POST['submit1'])) {
    if (empty($_POST['cr_user']) ||
        empty($_POST['cr_email']) ||
        empty($_POST['cr_pass']) ||
        empty($_POST['cr_cpass']) ||
        empty($_POST['code'])) {
        $message = "ALL fields must be filled";
    } else {
        $check_username = mysqli_query($db, "SELECT username FROM admin WHERE username = '" . $_POST['cr_user'] . "'");
        $check_email = mysqli_query($db, "SELECT email FROM admin WHERE email = '" . $_POST['cr_email'] . "'");
        $check_code = mysqli_query($db, "SELECT adm_id FROM admin WHERE code = '" . $_POST['code'] . "'");

        if ($_POST['cr_pass'] != $_POST['cr_cpass']) {
            $message = "Password does not match";
        } elseif (!filter_var($_POST['cr_email'], FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email address";
        } elseif (mysqli_num_rows($check_username) > 0) {
            $message = 'Username already exists';
        } elseif (mysqli_num_rows($check_email) > 0) {
            $message = 'Email already exists';
        } elseif (mysqli_num_rows($check_code) > 0) {
            $message = "Unique code already redeemed";
        } else {
            $result = mysqli_query($db, "SELECT id FROM admin_codes WHERE codes =  '" . $_POST['code'] . "'");
            if (mysqli_num_rows($result) == 0) {
                $message = "Invalid code";
            } else {
                $mql = "INSERT INTO admin (username, password, email, code) VALUES ('" . $_POST['cr_user'] . "','" . md5($_POST['cr_pass']) . "','" . $_POST['cr_email'] . "','" . $_POST['code'] . "')";
                mysqli_query($db, $mql);
                $success = "Admin added successfully!";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="icon" href="images/manager.png" class="thumbnail" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="container">
    <div class="info">
        <h1>Administration</h1>
        <span>Register Account</span>
    </div>
</div>
<div class="form">
  <div class="thumbnail"><img src="images/manager.png"/></div>
  <span style="color:red;"><?php echo $success; ?></span>
  <form class="login-form" action="register.php" method="post">
        <input type="text" placeholder="Username" name="cr_user"/>
        <input type="text" placeholder="Email Address" name="cr_email"/>
        <input type="password" placeholder="Password" name="cr_pass"/>
        <input type="password" placeholder="Confirm Password" name="cr_cpass"/>
        <input type="password" placeholder="Unique Code" name="code"/>
        <input type="submit" name="submit1" value="Create"/>
        <p class="message">Already registered? <a href="index.php">Sign In</a></p>
    </form>
 
  
  <span style="color:red;"><?php echo $message; ?></span>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='js/index.js'></script>
</body>
</html>
