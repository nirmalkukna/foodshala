<?php
   session_start();
   if(isset($_SESSION['login_user1'])){
   header('Location: manager/myrestaurant.php');
   }
   ?>
<html>
   <head>
      <title> HOME | FoodShala </title>
   </head>
   <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
   <link rel="stylesheet" type = "text/css" href ="css/index.css">
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
                  <li class="active" ><a href="index.php">Home</a></li>
                  <li><a href="contactus.php">Contact Us</a></li>
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
      <!-- Display banner image -->
      <div class="banner-image">
         <div class="banner-text">
            <h1>FoodShala</h1>
            <p>Order food from favourite restaurants</p>
            <a href="#foodlist"><button>ORDER NOW</button></a>
         </div>
      </div>
      <div class="container allfoodlist" id="foodlist">
         <div class="text-center recommend-food">
            <h3>Recommended Food Items</h3>
            <p class="text-dark">Order now your favourite food !</p>
         </div>
         <!-- Display all Food from food table -->
         <?php
            require 'connection.php';
            $conn = connect();

            $sql = "SELECT * FROM food WHERE options = 'ENABLE' LIMIT 16";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0)
            {
              $count=0;
            
              while($row = mysqli_fetch_assoc($result)){
                if ($count == 0)
                  echo "<div class='row'>";
            
            ?>
         <div class="col-md-4">
            <form method="post" action="cart.php?action=add&id=<?php echo $row["F_ID"]; ?>">
               <div class="main">
                  <ul class="cards">
                     <li class="cards_item">
                        <div class="card">
                           <div class="card_image"><img src="manager/<?php echo $row["images_path"]; ?>" class="img-responsive" style="height: 175px; width: 100%"></div>
                           <div class="card_content">
                              <div class="row">
                                 <div class="col-lg-6 col-md-6">
                                    <h2 class="card_title"><?php echo $row["name"]; ?> <span>(<?php echo $row["category_name"]; ?>)</span></h2>
                                 </div>
                                 <div class="col-lg-6 col-md-6">
                                    <p class="card_text text-dark blue" style="float: right;"><?php echo $row["R_Name"]; ?></p>
                                 </div>
                              </div>
                              <p class="card_text text-center"><?php echo $row["description"]; ?></p>
                              <p class="card_text text-center">Price: &#8377; <?php echo $row["price"]; ?>/-</p>
                              <h5 class="text-info quantity text-center">
                                 <p>Quantity:</p>
                                 <input type="number" min="1" max="20" name="quantity" class="form-control" value="1" style="width: 60px;"> 
                              </h5>
                              <input type="hidden" name="hidden_img" value="<?php echo $row["images_path"]; ?>">
                              <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
                              <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                              <input type="hidden" name="hidden_RID" value="<?php echo $row["R_ID"]; ?>">
                              </br>
                              <input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </form>
         </div>
         <?php
            $count++;
            if($count==3)
            {
              echo "</div>";
              $count=0;
            }
            }
            ?>
      </div>
      <?php
         }
         else
         {
           ?>
      <div class="container">
         <div class="jumbotron">
            <center>
               <label style="margin-left: 5px;color: red;">
                  <h1>Oops! No food is available.</h1>
               </label>
               <p>Stay Hungry...!</p>
            </center>
         </div>
      </div>
      <?php
         }
         
         ?>
      </div>
      <div class="container allfoodlist" id="foodlist">
         <div class="text-center recommend-food">
            <h3>Recommended Restaurant</h3>
            <p class="text-dark">Order now from your favourite restaurants!</p>
         </div>
         <!-- Display all Food from food table -->
         <?php
            $sqm = "SELECT * FROM restaurants ORDER BY RAND()";
            
            $results = mysqli_query($conn, $sqm);
            
            if (mysqli_num_rows($results) > 0)
            {
              $count=0;
            
              while($row = mysqli_fetch_assoc($results)){
                if ($count == 0)
                  echo "<div class='row'>";
            
            ?>
         <div class="col-md-3">
            <form method="post" action="dishs.php?R_ID=<?php echo $row["R_ID"]; ?>">
               <div class="main">
                  <ul class="cards">
                     <li class="cards_item">
                        <div class="card">
                           <div class="card_image"><img src="manager/<?php echo $row["res_img"]; ?>"></div>
                           <div class="card_content">
                              <h2 class="card_title"><?php echo $row["name"]; ?></h2>
                              <p class="card_text"><?php echo $row["address"]; ?></p>
                              <div class="rating">
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="clock"> <i class="fa fa-motorcycle"></i> 30 min</span>
                              </div>
                              <button class="btn card_btn">Quick View</button>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </form>
         </div>
         <?php
            $count++;
            if($count==4)
            {
              echo "</div>";
              $count=0;
            }
            }
            ?>
      </div>
      <?php
         }
         else
         {
           ?>
      <div class="container">
         <div class="jumbotron">
            <center>
               <label style="margin-left: 5px;color: red;">
                  <h1>Oops! No Restaurant is available.</h1>
               </label>
               <p>Stay Hungry...!</p>
            </center>
         </div>
      </div>
      <?php
         }
         
         ?>
      </div>
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