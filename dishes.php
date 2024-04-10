<?php
session_start();
include("connection/connect.php"); // connection to db
error_reporting(0);



function fetchDishesByRestaurantId($rs_id) {
    global $db; // Use the global database connection variable
    
    // Query to fetch dishes for the given restaurant ID
    $query = "SELECT * FROM dishes WHERE rs_id = '$rs_id'";
    $result = mysqli_query($db, $query);

    $dishes = array(); // Initialize an array to store fetched dishes
    
    // Loop through the result set and fetch dishes
    while ($row = mysqli_fetch_assoc($result)) {
        $dishes[] = $row; // Add fetched dish to the array
    }

    return $dishes; // Return the array of fetched dishes
}
if(isset($_GET['rs_id'])) {
    $rs_id = $_GET['rs_id'];
} else {
    // Handle the case where rs_id is not set in the URL
    // For example, redirect to an error page or display an error message
    echo "Restaurant ID (rs_id) is not set.";
    exit(); // Stop further execution
}
include_once 'product-action.php'; //including controller
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    // If the cart is empty, display a message
    $message = "You need to select dishes before checkout.";
} else {
    // If the cart is not empty, proceed to checkout
    // Redirect to checkout only if there are items in the cart
    header("Location: checkout.php?rs_id=$_GET[rs_id]");
    exit();
}

$dishes = fetchDishesByRestaurantId($rs_id);

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
    <title>Food Ordering Website</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> </head>

<body>
    
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
									
									
										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Order</a> </li>';
                                        echo  '<li class="nav-item"><a href="profile.php" class="nav-link active"><img src="images/profile.png" width="30"/></a> </li>';
							}

						?>
							 
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- /.navbar -->
        </header>
        <div class="page-wrapper">
            <!-- top Links -->
            <div class="top-links">
                <div class="container">
                    <ul class="row links">
                      
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose Restaurant</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active"><span>2</span><a href="dishes.php?rs_id=<?php echo $_GET['rs_id']; ?>">Pick Your favorite food</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay online</a></li>
                    </ul>
                </div>
            </div>
            <!-- end:Top links -->
            <!-- start: Inner page hero -->
			<?php $ress= mysqli_query($db,"select * from restaurant where rs_id='$_GET[rs_id]'");
									     $rows=mysqli_fetch_array($ress);
										  
										  ?>
            <section class="inner-page-hero bg-image" data-image-src="images/img/dish.jpeg">
                <div class="profile">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                                <div class="image-wrap">
                                    <figure><?php echo '<img src="admin/Res_img/'.$rows['image'].'" alt="Restaurant logo">'; ?></figure>
                                </div>
                            </div>
							
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                                <div class="pull-left right-text white-txt">
                                    <h6><a href="#"><?php echo $rows['title']; ?></a></h6>
                                    <p><?php echo $rows['address']; ?></p>
                                    <ul class="nav nav-inline">
                                        <li class="nav-item"> <a class="nav-link active" href="#"><i class="fa fa-check"></i> Min  150</a> </li>
                                        <li class="nav-item"> <a class="nav-link" href="#"><i class="fa fa-motorcycle"></i> 30 min</a> </li>
                                        <li class="nav-item ratings">
                                            <a class="nav-link" href="#"> <span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    </span> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
							
							
                        </div>
                    </div>
                </div>
            </section>
            <!-- end:Inner page hero -->
            <div class="breadcrumb">
                <div class="container">
                   
                </div>
            </div>
            <div class="container m-t-30">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                        
                         <div class="widget widget-cart">
                                <div class="widget-heading">
                                    <h3 class="widget-title text-dark">
                                 Your Shopping Cart
                              </h3>
							  				  
							  
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-row bg-white">
                                    <div class="widget-body">
									
									
	<?php

$item_total = 0;

foreach ($_SESSION["cart_item"] as $item)  // fetch items define current into session ID
{
?>									
									
                                        <div class="title-row">
										<?php echo $item["title"]; ?><a href="dishes.php?rs_id=<?php echo $_GET['rs_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>" >
										<i class="fa fa-trash pull-right"></i></a>
										</div>
										
                                        <div class="form-group row no-gutter">
                                            <div class="col-xs-8">
                                                
                                                 <input type="text" class="form-control b-r-0" value=<?php echo $item["price"]; ?> readonly id="exampleSelect1">
                                                   
                                            </div>
                                            <div class="col-xs-4">
                                               <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input"> </div>
                                               <strong>+40 Shipping Charges</strong>
									  </div>
									  
	<?php
// Calculate the total price of items in the cart
foreach ($_SESSION["cart_item"] as $item) {
    $item_total += ($item["price"] * $item["quantity"]);
}

// Add the shipping fee
$item_total += 40; // Assuming the shipping fee is 40 Rs

}
?>								  
									  
									  
									  
                                    </div>
                                </div>
                               
                                <!-- end:Order row -->
                             <php echo $message; ?>
                                <div class="widget-body">
                                    <div class="price-wrap text-xs-center">
                                        <p>TOTAL</p>
                                        <h3 class="value"><strong><?php echo $item_total; ?></strong></h3>
                                       
                                        <a href="checkout.php?d_id=<?php echo $d_id; ?>&rs_id=<?php echo $rs_id; ?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>
								
						
								
								
                            </div>
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
                      
                        <!-- end:Widget menu -->
                        <div class="menu-widget" id="2">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                              POPULAR ORDERS Delicious hot food! <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                              <i class="fa fa-angle-right pull-right"></i>
                              <i class="fa fa-angle-down pull-right"></i>
                              </a>
                           </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="collapse in" id="popular2">
						<?php  // display values and item of food/dishes
									$stmt = $db->prepare("select * from dishes where rs_id='$_GET[rs_id]'");
									$stmt->execute();
									$products = $stmt->get_result();
									if (!empty($products)) 
									{
									foreach($products as $product)
										{
						
													
													 
													 ?>
                                <div class="food-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-8">
										<form method="post" action='dishes.php?rs_id=<?php echo $_GET['rs_id'];?>&action=add&id=<?php echo $product['d_id']; ?>'>
                                            <div class="rest-logo pull-left">
                                                <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="admin/Res_img/dishes/'.$product['img'].'" alt="Food logo">'; ?></a>
                                            </div>
                                            <!-- end:Logo -->
                                            <div class="rest-descr">
                                                <h6><a href="#"><?php echo $product['title']; ?></a></h6>
                                                <p> <?php echo $product['slogan']; ?></p>
                                            </div>
                                            <!-- end:Description -->
                                        </div>
                                        <!-- end:col -->
                                        <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info"> 
										<span class="price pull-left" ><?php echo $product['price']; ?></span>
										  <input class="b-r-0" type="text" name="quantity"  style="margin-left:30px;" value="1" size="2" />
										  <input type="submit" class="btn theme-btn" style="margin-left:40px;" value="Add to cart" />
										</div>
										</form>
                                    </div>
                                    <!-- end:row -->
                                </div>
                                <!-- end:Food item -->
								
								<?php
									  }
									}
									
								?>
								
								
                              
                            </div>
                            <!-- end:Collapse -->
                        </div>
                        <!-- end:Widget menu -->
                       
                    </div>
                    <!-- end:Bar -->
                    
                    <!-- end:Right Sidebar -->
                </div>
                <!-- end:row -->
            </div>
            <!-- end:Container -->
           
        </div>
        <!-- end:page wrapper -->
    </div>
    <!--/end:Site wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <div class="modal-body cart-addon">
                    <div class="food-item white">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left"> 290</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect2">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-2"> </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left"> 209</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect3">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-3"> </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left"> 169</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect5">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-4"> </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left"> 135</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect6">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-5"> </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn theme-btn">Add to cart</button>
                </div>
            </div>
        </div>
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
