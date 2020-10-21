<?php
   session_start();
   require 'connection.php';
   $conn = Connect();
   if(isset($_SESSION['login_user1'])){
     header('Location: manager/myrestaurant.php');
   }
   ?>
<html>
   <head>
      <title> Contact US | FoodShala </title>
      <style type="text/css">
         .btn-primary {
             color: #fff;
             background-color: #499D44 !important;
             border-color: #499D44 !important;
         }
      </style>
      <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
      <link rel="stylesheet" type = "text/css" href ="css/index.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   
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
                  <li ><a href="index.php">Home</a></li>
                  <li class="active"><a href="contactus.php">Contact Us</a></li>
               </ul>
               <?php
                  if (isset($_SESSION['login_user2'])) {
                   ?>
               <ul class="nav navbar-nav navbar-right">
                  <li><a href="cart.php"><span class="fa fa-shopping-cart"> Cart</span>
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
      <br>
      <div class="container" >
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
               <div class="col-md-12" style="float: none; margin: 0 auto;">
                  <div class="form-area">
                     <form method="post" action="">
                        <br style="clear: both">
                        <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Contact US</h3>
                        <div class="form-group">
                           <input type="text" class="form-control" id="name" name="name" placeholder="Name" required autofocus="">
                        </div>
                        <div class="form-group">
                           <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                           <input type="Number" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" required>
                        </div>
                        <div class="form-group">
                           <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                           <textarea class="form-control" type="textarea" id="message" name="message" placeholder="Message" maxlength="140" rows="7"></textarea>
                        </div>
                        <input type="submit" name="submit" type="button" id="submit" name="submit" class="btn btn-primary pull-right"/>    
                     </form>
                  </div>
               </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 maps-col">
               <iframe width="100%" height="94%" id="gmap_canvas" src="https://maps.google.com/maps?q=shree%20ram%20south%20court&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            </div>
         </div>
      </div>
      <?php
         if (isset($_POST['submit'])){
         require 'connection.php';
         $conn = Connect();
         
         $Name = $conn->real_escape_string($_POST['name']);
         $Email_Id = $conn->real_escape_string($_POST['email']);
         $Mobile_No = $conn->real_escape_string($_POST['mobile']);
         $Subject = $conn->real_escape_string($_POST['subject']);
         $Message = $conn->real_escape_string($_POST['message']);
         
         $query = "INSERT into contact(Name,Email,Mobile,Subject,Message) VALUES('$Name','$Email_Id','$Mobile_No','$Subject','$Message')";
         $success = $conn->query($query);
         
         if (!$success){
           die("Couldnt enter data: ".$conn->error);
         }
         
         $conn->close();
         }
         ?>
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