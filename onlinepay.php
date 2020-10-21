<?php
   session_start();
   require 'connection.php';
   $conn = Connect();
   if(!isset($_SESSION['login_user2']) || !isset($_SESSION['cart'])){
   header("location: customerlogin.php"); 
   }
   if(isset($_SESSION['login_user1'])){
     header('Location: manager/myrestaurant.php');
   }
   
   ?>
<html>
   <head>
      <title> Cart | FoodShala </title>
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
      <div class="container">
         <div class="row">
            <div class="jumbotron">
               <h2 class="text-center"><b>Online Payment<b></h2>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6 col-md-offset-3">
               <div class="credit-card-div">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <div class="row">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <h5 class="text-muted"> Credit Card Number</h5>
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-3">
                              <input type="text" class="form-control" placeholder="0000" required="" />
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-3">
                              <input type="text" class="form-control" placeholder="0000" required="" />
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-3">
                              <input type="text" class="form-control" placeholder="0000" required="" />
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-3">
                              <input type="text" class="form-control" placeholder="0000" required="" />
                           </div>
                        </div>
                        <br>
                        <div class="row ">
                           <div class="col-md-3 col-sm-3 col-xs-3">
                              <span class="help-block text-muted small-font"> Expiry Month</span>
                              <input type="text" class="form-control" placeholder="MM" required="" />
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-3">
                              <span class="help-block text-muted small-font">  Expiry Year</span>
                              <input type="text" class="form-control" placeholder="YY" required="" />
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-3">
                              <span class="help-block text-muted small-font">  CCV</span>
                              <input type="text" class="form-control" placeholder="CCV" required="" />
                           </div>
                           <div class="col-md-3 col-sm-3 col-xs-3"><br>
                              <img src="images/creditcard.png" class="img-rounded" required="" />
                           </div>
                        </div>
                        <br>
                        <div class="row ">
                           <div class="col-md-12 pad-adjust">
                              <input type="text" class="form-control" placeholder="Name On The Card" required="" />
                           </div>
                        </div>
                        <br>
                        <div class="row">
                           <div class="col-md-12 pad-adjust">
                              <div class="checkbox">
                                 <label>
                                 <input type="checkbox" checked class="text-muted" required=""> Save details for fast payments. <a href="#">Learn More</a>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="row ">
                           <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                              <a href="payment.php"><input type="submit" class="btn btn-danger btn-block" value="CANCEL" required="" /></a>   
                           </div>
                           <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                              <a href="COD.php"><input type="submit" class="btn btn-success btn-block" value="PAY NOW" required="" /></a>  
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
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