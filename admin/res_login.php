<?php
session_start();
include("../connection/connect.php"); // INCLUDE CONNECTION
error_reporting(0); // HIDE UNDEFINED INDEX ERRORS

if(isset($_POST['submit'])) { // IF BUTTON IS SUBMITTED
    $email = $_POST['username']; // FETCH RECORDS FROM LOGIN FORM
    $password = $_POST['password'];

    if(!empty($_POST["submit"])) { // IF RECORDS WERE NOT EMPTY
        $loginquery ="SELECT * FROM restaurant WHERE email=? AND password=?"; // SELECTING MATCHING RECORDS
        $stmt = $db->prepare($loginquery);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if($row) { // IF MATCHING RECORDS IN THE ARRAY & IF EVERYTHING IS RIGHT
            $_SESSION["res_id"] = $row['rs_id']; // PUT USER ID INTO TEMP SESSION
            $success = "Login successful!";
            header("refresh:1;url=res_dashboard.php"); // REDIRECT TO DASHBOARD PAGE
        } else {
            $message = "Invalid Username or Password!"; // THROW ERROR
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>login</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/login.css">
	  <link rel="icon" href="/images/logo.png">
	  <style type="text/css">
	  #buttn{
		  color:#fff;
		  background-color: #ff3300;
	  }
	  </style>
  
</head>

<body>

  
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>Login Form</h1>
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle">
   
  </div>
  <div class="form">
    <h2>Login to your account</h2>
	  <span style="color:red;"><?php echo $message; ?></span> 
   <span style="color:green;"><?php echo $success; ?></span>
    <form action="" method="post">
      <input type="text" placeholder="Username"  name="username"/>
      <input type="password" placeholder="Password" name="password"/>
      <input type="submit" id="buttn" name="submit" value="login" />
    </form>
  </div>
  
 
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

   



</body>



</html>
