<?php
session_start();
error_reporting(0);

include("connection/connect.php");
include_once 'product-action.php';

$_SESSION['order_placed'] = true;

// Check if the rs_id is set in the URL parameters
if (isset($_GET['rs_id'])) {
    // Retrieve rs_id from the URL
    $rs_id = $_GET['rs_id'];
} else {
    // Handle the case when rs_id is not set in the URL
    // For example, you can redirect the user back to the page where they select a restaurant
    header('Location: restaurants.php');
    exit(); // Stop further execution
}

// Check if the user is logged in
if (empty($_SESSION["user_id"])) {
    header('location:login.php');
    exit(); // Stop further execution
} else {
    $success = "";

    if (isset($_POST['submit'])) {
        // Retrieve user ID from session
        $user_id = $_SESSION["user_id"];
        $item_total = 0;

        foreach ($_SESSION["cart_item"] as $item_id => $item) {
            $item_total += ($item["price"] * $item["quantity"]);

            // Capture instruction from the form
            $instruction = mysqli_real_escape_string($db, $_POST["instruction"]);

            // Retrieve d_id from the cart item
            $d_id = $item['d_id'];

            // Insert into users_orders table with rs_id and d_id
            $SQL = "INSERT INTO users_orders(u_id, rs_id, d_id, title, quantity, price, instruction) VALUES ('$user_id', '$rs_id', '$d_id', '{$item["title"]}', '{$item["quantity"]}', '{$item["price"]}', '$instruction')";

            if (mysqli_query($db, $SQL)) {
                $success = "Thank you! Your Order Placed successfully! You will be redirected to your order in <span id='counter'>2</span> second(s). <script type='text/javascript'>
                    function countdown() {
                        var i = document.getElementById('counter');
                        if (parseInt(i.innerHTML) <= 0) {
                            location.href = 'pay.php';
                        }
                        i.innerHTML = parseInt(i.innerHTML) - 1;
                    }
                    setInterval(function () { countdown(); }, 1000);
                    </script>";
            } else {
                // Error handling if the query fails
                $success = "Error: " . $SQL . "<br>" . mysqli_error($db);
            }
        }
    }

    // Calculate total cost including shipping fee
    $item_total = 0; // Reset item_total variable
    foreach ($_SESSION["cart_item"] as $item) {
        $item_total += ($item["price"] * $item["quantity"]);
    }

    // Add the shipping fee
    $item_total += 40; // Assuming the shipping fee is 40 Rs
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/images/logo.png">
    <title>payment panel</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
 </head>
<body>
    <div class="site-wrapper">
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.html"> <img class="img-rounded" src="images/food-picky-logo.png" alt=""> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a> </li>
                            
							<?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">signup</a> </li>';
							}
						else
							{
									
									
										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">your orders</a> </li>';
                                        echo  '<li class="nav-item"><a href="profile.php" class="nav-link active">My Profile</a> </li>';
							}

						?>
							 
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- /.navbar -->
        </header>
        <div class="page-wrapper">
            <div class="top-links">
                <div class="container">
                    <ul class="row links">
                      
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose Restaurant</a></li>
                        <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Pick Your favorite food</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active" ><span>3</span><a href="checkout.php">Order and Pay online</a></li>
                    </ul>
                </div>
            </div>
			
                <div class="container">
                 
					   <span style="color:green;">
								<?php echo $success; ?>
										</span>
					
                </div>
            
			
			
				  
            <div class="container m-t-30">
			<form action="" method="post">
                <div class="widget clearfix">
                    
                    <div class="widget-body">
                        <form method="post" action="#">
                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Cart Summary</h4> </div>
                                              
                    <div class="cart-totals-fields">
										
                                            <table class="table">
											<tbody>
                                          
												 
											   
                                                    <tr>
                                                        <td>Cart Subtotal</td>
                                                        <td> <?php echo $item_total; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping &amp; Handling</td>
                                                        <td>40</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Total</strong></td>
                                                        <td class="text-color"><strong> <?php echo $item_total; ?></strong></td>
                                                    </tr>
                                                </tbody>
												
												
												
												
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <section class="contact-page inner-page">
               <div class="container">
                  <div class="row">
                     <!-- REGISTER -->
                     <div class="col-md-8">
                        <div class="widget">
                           <div class="widget-body">
                           <h3><strong>Instruction</strong></h3>
							  <form action="" method="post">
                                 <div class="row">
                                 <div class="form-group col-sm-12">
                                    <textarea class="form-control" id="exampleTextarea" name="instruction" placeholder="Instruction" rows="3" ></textarea>
                                </div>

                                   
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>

<br>
<center>
<strong>NOTE:</strong><span style="color:red;">*Average Time for Preparing the Food is 10 min*</span>
</center>
                                    <!--cart summary-->
                                    <div class="payment-option">
                                        <ul class=" list-unstyled">
                                            <li>
                                                <label class="custom-control custom-radio  m-b-20">
                                                    <input name="mod" id="radioStacked1"  value="COD" type="radio" class="custom-control-input" required> <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="images/cash.png" alt="" width="25" />Take Away</span>
                                                   </label>
                                            </li>
                                            <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                <input name="mod"  value="paypal" type="radio" class="custom-control-input" required> <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="images/payment.png" alt="" width="25" />Net Banking<br><sub style="color:green;">Paypal, Credit Card, Debit Card, Gpay</sub></span>   
                                                
                                            </li>
                                           
                                        </ul>
                                        <p class="text-xs-center">
                                        <input type="submit" onclick="return handleButtonClick();" name="submit" class="btn btn-outline-success btn-block" value="Order now">
                                    </p>

                                    </div>
									</form>
                                </div>
                            </div>
                       
                    </div>
                </div>
				 </form>
              
                 <script>
        function handleButtonClick() {
            var onlinePaymentRadio = document.getElementById('onlinePayment');

            // Check if Online Payment radio button is checked
            if (onlinePaymentRadio.checked) {
                // If Online Payment radio button is checked, proceed with the confirmation dialog
                return confirm('Are you sure you want to proceed with the online payment?');
            } else {
                // If no payment method is selected, alert the user
                alert('Please select Online Payment as the payment method.');
                return false; // Prevent form submission
            }
        }
    </script>

            </div>
            
        </div>
        <!-- end:page wrapper -->
         </div>

     <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
    
</body>

</html>
