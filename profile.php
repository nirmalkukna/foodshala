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
      <style type="text/css">
         .card {
         box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
         max-width: 400px;
         margin: 50px auto;
         text-align: center;
         font-family: arial;
         padding: 10px;
         }
         .float-right {
         float: right;
         }
         .form-area {
             background-color: #FAFAFA;
             padding: 10px !important;
             margin: 0px 0px 50px;
             border: 1px solid #3C6F9B;
             opacity: 0.9;
         }
      </style>
      <link rel="stylesheet" type = "text/css" href ="css/payment.css">
      <link rel="stylesheet" type = "text/css" href ="css/payment.css">
      <link rel="stylesheet" type = "text/css" href ="css/index.css">
      <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
      <script type="text/javascript" src="js/jquery.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
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
                  <li><a href="index.php">Home</a></li>
                  <li><a href="contactus.php">Contact Us</a></li>
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
                  <li class="active"><a href="profile.php"><span class="fa fa-user"></span> <?php echo $_SESSION['login_user2']; ?> </a></li>
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
      <div class="card">
         <?php
            // Storing Session
            $user_check=$_SESSION['login_user2'];
            $sql = "SELECT * FROM customer c WHERE c.username='$user_check'";
            $result = mysqli_query($conn, $sql);
            
            while ($row = mysqli_fetch_array($result))
            {
            
              ?>
         <img src="manager/images/logo.jpg" alt="John" style="width:30%">
         <div class="row" style="margin-top: 20px">
            <div class="col-lg-6 col-md-6 col-sm-6">
               <b> Name <span class="float-right">:</span></b>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
               <?php echo $row["fullname"]; ?>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
               <b>Username <span class="float-right">:</span></b>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
               <?php echo $row["username"]; ?>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
               <b>Email <span class="float-right">:</span></b>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
               <?php echo $row["email"]; ?>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
               <b>Contact <span class="float-right">:</span></b>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
               <?php echo $row["contact"]; ?>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
               <b>Address <span class="float-right">:</span></b>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
               <?php echo $row["address"]; ?>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
               <b>Category <span class="float-right">:</span></b>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
               <?php echo $row["category"]; ?>
            </div>
         </div>
         <br>
         <?php }  ?>
      </div>

      <section class="container">
      <div class="col-lg-12">
         <div class="form-area">
            <form action="" method="POST">
               <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> My Orders</h3>
               <?php
                  // Storing Session
                  $user_check=$_SESSION['login_user2'];
                  $sql = "SELECT * FROM orders o WHERE o.username='$user_check' ORDER BY F_ID";
                  $result = mysqli_query($conn, $sql);
                  
                  
                  if (mysqli_num_rows($result) > 0)
                  {
                  
                    ?>
               <table class="table table-striped">
                  <thead class="thead-dark">
                     <tr>
                        <th> Food ID </th>
                        <th> Food Name </th>
                        <th> Price </th>
                        <th> Quantity </th>
                        <th> Order Date </th>
                     </tr>
                  </thead>
                  <?PHP
                     //OUTPUT DATA OF EACH ROW
                     while($row = mysqli_fetch_assoc($result)){
                     ?>
                  <tbody>
                     <tr>
                        <td><?php echo $row["F_ID"]; ?></td>
                        <td><?php echo $row["foodname"]; ?></td>
                        <td><?php echo $row["price"]; ?></td>
                        <td><?php echo $row["quantity"]; ?></td>
                        <td><?php echo $row["order_date"]; ?></td>
                     </tr>
                  </tbody>
                  <?php } ?>
               </table>
               <br>
               <?php } else { ?>
               <h4 style="color: red">
                  <center>No Orders Yet.</center>
               </h4>
               <?php } ?>
            </form>
         </div>
      </div>
   </section>



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