<?php
session_start();
error_reporting(E_ALL);

// Redirect to login page if user is not logged in
if (empty($_SESSION["user_id"])) {
    header('location: login.php');
    exit(); // Stop further execution
}

// Include database connection file
include("connection/connect.php");

// Fetch user details from the database
$user_id = $_SESSION["user_id"];
$query = "SELECT username, email, phone, address FROM users WHERE u_id = $user_id";
$result = mysqli_query($db, $query);

// Check if user exists
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['username'];
    $email = $row['email'];
    $number = $row['phone'];
    $address = $row['address'];
} else {
    echo "User details not found.";
    exit;
}

// Get the current date and time
$current_datetime = date("Y-m-d H:i:s");
// Calculate the total amount
$item_total = 0;
foreach ($_SESSION["cart_item"] as $item) {
    $item_total += ($item["price"] * $item["quantity"]);
}
// Add the shipping fee
$item_total += 40; // Assuming the shipping fee is 40 Rs
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Details</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/images/logo.png">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> 
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> 
<link href="css/payment.css" rel="stylesheet">

</head>
<center>
<body class="home">
    <!-- Header -->
    <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/food-picky-logo.png" alt=""> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a> </li>
                            <?php
                                if(empty($_SESSION["user_id"])) { // if user is not login
                                    echo '<li class="nav-item"><a href="login.php" class="nav-link active">login</a> </li>
                                    <li class="nav-item"><a href="registration.php" class="nav-link active">signup</a> </li>';
                                } else { //if user is login
                                    echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">your orders</a> </li>';
                                    echo '<li class="nav-item"><a href="profile.php" class="nav-link active"><img src="images/profile.png" width="30"/></a> </li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- /.navbar -->
    </header>
    <center>
        <div class="form-row">
            <div class="input-data">
                <div class="underline"></div>
                <br>
                <h2>Payment </h2>
                <div class="form-row">
                    <div class="input-data">
                        <div class="underline"></div>
                        <table class="table">
                            <tbody>
                                <tr><br>
                                    <td><strong>Payer's name:</strong></td>
                                    <td><?php echo $name; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td><?php echo $email; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Phone Number:</strong></td>
                                    <td><?php echo $number; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Address:</strong></td>
                                    <td><?php echo $address; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Price:</strong></td>
                                    <td><?php echo $item_total; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Date and Time:</strong></td>
                                    <td><?php echo $current_datetime; ?></td>
                                </tr>
                            </tbody>
                        </table>
                            </center>
                        <!-- Form to proceed with payment -->
                        <form action="payment_process.php" method="post">
                            <button type="button" class="btn btn-primary launch buynow" data-toggle="modal" data-target="#staticBackdrop">
                                <i class="fa fa-rocket "></i>  <a href="javascript:void(1)" ><span style="color:white;">Pay Now:<?php echo $item_total; ?></span></a>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                            <script>
$('.buynow').click(function(e) {
    var options = {
        "key": "rzp_test_hhhQ54G1CEvcny", // Enter the Key ID generated from the Dashboard
        "amount": <?php echo $item_total; ?> * 100, // Amount is in currency subunits. Multiply by 100 for INR.
        "currency": "INR",
        "name": "Food Picku", // Your business name
        "description": "Test Transaction",
        "image": "images/logo.png",
        "handler": function(response) {
            // Send payment ID to update_payment.php
            $.ajax({
                type: "POST",
                url: "",
                data: { payment_id: response.razorpay_payment_id },
                success: function() {
                    // Redirect after successful payment
                    window.location.href = 'your_orders.php';
                }
            });
        },
        "theme": {
            "color": "#3399cc"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
    e.preventDefault();
});
</script>


                            </button>
                            <!-- Modal -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </center>
</body>
</html>
