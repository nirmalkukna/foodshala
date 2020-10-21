<?php
   session_start();
   require 'connection.php';
   $conn = Connect();
   if(!isset($_SESSION['login_user2'])){
   header("location: customerlogin.php"); 
   }
   if(isset($_SESSION['login_user1'])){
     header('Location: manager/myrestaurant.php');
   }
   ?>
<html>
   <head>
      <title> Payment | FoodShala </title>
   </head>
   <link rel="stylesheet" type = "text/css" href ="css/payment.css">
   <link rel="stylesheet" type = "text/css" href ="css/index.css">
   <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
   <script type="text/javascript" src="js/jquery.min.js"></script>
   <script type="text/javascript" src="js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <body>
      <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="index.php">FoodShala</a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
               <ul class="nav navbar-nav">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="contactus.php">Contact Us</a></li>
               </ul>
               <?php
                  if (isset($_SESSION['login_user2'])) {
                   ?>
               <ul class="nav navbar-nav navbar-right">
                  
                  <li class="active"><a href="cart.php"><span class="fa fa-shopping-cart"> Cart</span>
                     (<?php
                        if(isset($_SESSION["cart"])){
                        $count = count($_SESSION["cart"]); 
                        echo "$count"; 
                        }
                        else
                          echo "0";
                        ?>)
                     </a>
                  </li>
                  <li><a href="profile.php"><span class="fa fa-user"></span> <?php echo $_SESSION['login_user2']; ?> </a></li>
                  <li><a href="logout_u.php"><span class="fa fa-sign-out"></span> Log Out </a></li>
               </ul>
               <?php        
                  }
                  else {
                  
                    ?>
               <ul class="nav navbar-nav navbar-right">
                  <li> <a href="customerlogin.php">Login</a></li>
                  <li> <a href="customersignup.php">Sign up</a></li>
               </ul>
               <?php
                  }
                  ?>
            </div>
         </div>
      </nav>
      <?php
         $gtotal = 0;
           foreach($_SESSION["cart"] as $keys => $values)
           {
         
             $F_ID = $values["food_id"];
             $foodname = $values["food_name"];
             $quantity = $values["food_quantity"];
             $price =  $values["food_price"];
             $total = ($values["food_quantity"] * $values["food_price"]);
             $R_ID = $values["R_ID"];
             $username = $_SESSION["login_user2"];
             $order_date = date('Y-m-d');
             
             $gtotal = $gtotal + $total;
         
         
              $query = "INSERT INTO orders (F_ID, foodname, price,  quantity, order_date, username, R_ID) 
                       VALUES ('" . $F_ID . "','" . $foodname . "','" . $price . "','" . $quantity . "','" . $order_date . "','" . $username . "','" . $R_ID . "')";
                      
         
                       $success = $conn->query($query);         
         
               if(!$success)
               {
                 ?>
      <div class="container">
         <div class="jumbotron">
            <h1>Something went wrong!</h1>
            <p>Try again later.</p>
         </div>
      </div>
      <?php
         }
         
         }
         
           ?>
      <div class="container">
         <div class="jumbotron">
            <h2>Choose your payment option</h2>
         </div>
      </div>
      <br>
      <h1 class="text-center">Grand Total: &#8377;<?php echo "$gtotal"; ?>/-</h1>
      <h5 class="text-center">including all service charges. (no delivery charges applied)</h5>
      <br>
      <h1 class="text-center">
         <a href="cart.php"><button class="btn btn-warning"><span class="fa fa-arrow-left"></span> Go back to cart</button></a>
         <a href="onlinepay.php"><button class="btn btn-success"><span class="fa fa-credit-card"></span> Pay Online</button></a>
         <a href="COD.php"><button class="btn btn-success"><span class="fa fa-money"></span> Cash On Delivery</button></a>
      </h1>
      <br><br><br><br>
      <footer class="site-footer">
         <div class="container">
            <div class="row">
               <div class="col-sm-12 col-md-4">
                  <h6>Address</h6>
                  <p class="text-justify">ISI-2, Abc Marg, Gurgaon <br> India (302020)</p>
               </div>
               <div class="col-xs-6 col-md-5">
                  <h6>About</h6>
                  <p class="text-justify">Good food is always cooking! Go ahead, order some yummy items from the menu. Order in for yourself or for the group, with no restrictions on order value.</p>
               </div>
               <div class="col-xs-6 col-md-3">
                  <h6>Quick Links</h6>
                  <ul class="footer-links">
                     <?php
                        if (!isset($_SESSION['login_user2'])) {
                        ?>
                     <li><a href="manager/index.php">Restaurant Login</a></li>
                     <li><a href="manager/managersignup.php">Restaurant Signup</a></li>
                     <?php
                        }
                          ?>
                     <li><a href="#">About Us</a></li>
                     <li><a href="#">Contact Us</a></li>
                  </ul>
               </div>
            </div>
            <hr>
         </div>
         <div class="container">
            <div class="row">
               <div class="col-md-8 col-sm-6 col-xs-12">
                  <p class="copyright-text">Copyright &copy; 2020 All Rights Reserved by 
                     <a href="#">FoodShala</a>.
                  </p>
               </div>
               <div class="col-md-4 col-sm-6 col-xs-12">
                  <ul class="social-icons">
                     <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                     <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                     <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
      </footer>
   </body>
</html>