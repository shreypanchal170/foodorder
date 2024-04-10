<?php
session_start();
// Include the database connection file
include('connection/connect.php');
if (empty($_SESSION["user_id"])) {
    header('location:login.php');
} else {
    $success = "";
}
// Start the session

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Account Information</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/img/main.jpeg');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .profile {
            max-width: 400px;
            max-height: 700px;
            height: 600px;
            width: 400px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border: 2px solid #dee2e6;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 40px;
            /* Adjust the value to lower or raise the box */
        }

        .form-control {
            margin-bottom: 15px;
        }

        .navbar {
            background-color: #fff !important;
            position: absolute;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
    </style>
</head>

<body class="home">
    <!-- Header -->
    <header id="header" class="header-scroll top-header headrom">
        <!-- .navbar -->
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse"
                    data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/food-picky-logo.png"
                        alt=""> </a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span
                                    class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span
                                    class="sr-only"></span></a> </li>


                        <?php
								if(empty($_SESSION["user_id"])) // if user is not login
								{
									echo '<li class="nav-item"><a href="login.php" class="nav-link active">login</a> </li>
									<li class="nav-item"><a href="registration.php" class="nav-link active">signup</a> </li>';
								}
								else
								{
										//if user is login
										
										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Order</a> </li>';
										echo  '<li class="nav-item"><a href="profile.php" class="nav-link active"><img src="images/profile.png" width="30"/></a> </li>';
									
								}
						?>


                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->


        <center>
            <div class="profile">
                <h1><strong>Account Information</strong></h1>
                <?php
							// Fetch user details from the database
							$user_id = $_SESSION['user_id'];
							$sql = "SELECT * FROM users WHERE u_id = $user_id";
							$query = mysqli_query($db, $sql);

							if (mysqli_num_rows($query) > 0) {
								while ($row = mysqli_fetch_array($query)) {
									echo '
										
											<table class="table">
												<tr>
													<td><strong>Firstname:</strong></td>
													<td>' . $row['f_name'] . '</td>
												</tr>
												<tr>
													<td><strong>Lastname:</strong></td>
													<td>' . $row['l_name'] . '</td>
												</tr>
                                                <tr>
													<td><strong>Email:</strong></td>
													<td>' . $row['email'] . '</td>
												</tr>
												<tr>
													<td><strong>Username:</strong></td>
													<td>' . $row['username'] . '</td>
												</tr>
												<tr>
													<td><strong>Address:</strong></td>
													<td>' . $row['address'] . '</td>
												</tr>
												<tr>
													<td><strong>Phone Number:</strong></td>
													<td>' . $row['phone'] . '</td>
												</tr>
											</table>
										
									';
								}
							} else {
								echo '<div class="alert alert-danger">No User Found!</div>';
							}
						?>  
                <button class="button-24" role="button" ><span style="color:white;"><a href="logout.php"><img src="images/logout.png" width="30" /></a></span></button>
            </div>
        </div>

    </center>

    <!-- End Main Content -->

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>
