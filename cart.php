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
      <title> Cart | FoodShala </title>
   </head>
   <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
   <link rel="stylesheet" type = "text/css" href ="css/index.css">
   <link rel="stylesheet" type = "text/css" href ="css/cart.css">
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
               </ul>
               <?php
                  if (isset($_SESSION['login_user2'])) {
                      ?>
               <ul class="nav navbar-nav navbar-right">
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
         if(!empty($_SESSION["cart"]))
         {
           ?>
      <div class="container">
         <div class="jumbotron">
            <h3>Your Cart</h3>
         </div>
      </div>
      <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;" >
         <table class="table table-striped">
            <thead class="thead-dark">
               <tr>
                  <th width="20%">Food Image</th>
                  <th width="20%">Food Name</th>
                  <th width="10%">Quantity</th>
                  <th width="15%">Price Details</th>
                  <th width="15%">Order Total</th>
                  <th width="10%">Remove</th>
               </tr>
            </thead>
            <?php  
               $total = 0;
               foreach($_SESSION["cart"] as $keys => $values)
               {
               ?>
            <tr>
               <td><img src="manager/<?php echo $values["images_path"]; ?>" class="img-responsive" style="width: 100px; height: 75px"></td>
               <td><?php echo $values["food_name"]; ?></td>
               <td><?php echo $values["food_quantity"] ?></td>
               <td>&#8377; <?php echo $values["food_price"]; ?></td>
               <td>&#8377; <?php echo number_format($values["food_quantity"] * $values["food_price"], 2); ?></td>
               <td><a href="cart.php?action=delete&id=<?php echo $values["food_id"]; ?>"><i class="fa fa-trash"></i></a></td>
            </tr>
            <?php 
               $total = $total + ($values["food_quantity"] * $values["food_price"]);
               }
               ?>
            <tr>
               <td colspan="4" align="right">Total</td>
               <td colspan="1" align="right">&#8377; <?php echo number_format($total, 2); ?></td>
            </tr>
         </table>
         <?php
            echo '<a href="cart.php?action=empty"><button class="btn btn-danger"><span class="fa fa-trash"></span> Empty Cart</button></a>&nbsp;<a href="index.php"><button class="btn btn-warning">Continue Shopping</button></a>&nbsp;<a href="payment.php"><button class="btn btn-success pull-right"><span class="fa fa-share-alt"></span> Check Out</button></a>';
            ?>
      </div>
      <br><br><br><br><br><br><br>
      <?php
         }
         if(empty($_SESSION["cart"]))
         {
           ?>
      <div class="container cart-empty-body">
         <div class="row">
            <div class="col-md-12">
               <div class="card mt-100">
                  <div class="card-body cart">
                     <div class="col-sm-12 empty-cart-cls text-center">
                        <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3">
                        <h3><strong>Your Cart is Empty</strong></h3>
                        <h4>Add something to make me happy :)</h4>
                        <a href="index.php" class="btn btn-primary cart-btn-transform m-3" data-abc="true">continue shopping</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
      <?php
         }
         ?>
      <?php
         if(isset($_POST["add"]))
         {
         if(isset($_SESSION["cart"]))
         {
         $item_array_id = array_column($_SESSION["cart"], "food_id");
         if(!in_array($_GET["id"], $item_array_id))
         {
         $count = count($_SESSION["cart"]);
         
         $item_array = array(
         'food_id' => $_GET["id"],
         'images_path' => $_POST["hidden_img"],
         'food_name' => $_POST["hidden_name"],
         'food_price' => $_POST["hidden_price"],
         'R_ID' => $_POST["hidden_RID"],
         'food_quantity' => $_POST["quantity"]
         );
         $_SESSION["cart"][$count] = $item_array;
         echo '<script>window.location="cart.php"</script>';
         }
         else
         {
         echo '<script>alert("Products already added to cart")</script>';
         echo '<script>window.location="cart.php"</script>';
         }
         }
         else
         {
         $item_array = array(
         'food_id' => $_GET["id"],
         'images_path' => $_POST["hidden_img"],
         'food_name' => $_POST["hidden_name"],
         'food_price' => $_POST["hidden_price"],
         'R_ID' => $_POST["hidden_RID"],
         'food_quantity' => $_POST["quantity"]
         );
         $_SESSION["cart"][0] = $item_array;
         }
         }
         if(isset($_GET["action"]))
         {
         if($_GET["action"] == "delete")
         {
         foreach($_SESSION["cart"] as $keys => $values)
         {
         if($values["food_id"] == $_GET["id"])
         {
         unset($_SESSION["cart"][$keys]);
         echo '<script>alert("Food has been removed")</script>';
         echo '<script>window.location="cart.php"</script>';
         }
         }
         }
         }
         
         if(isset($_GET["action"]))
         {
         if($_GET["action"] == "empty")
         {
         foreach($_SESSION["cart"] as $keys => $values)
         {
         
         unset($_SESSION["cart"]);
         echo '<script>alert("Cart is made empty!")</script>';
         echo '<script>window.location="cart.php"</script>';
         
         }
         }
         }
         
         
         ?>
      <?php
         ?>
      <!-- Site footer -->
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