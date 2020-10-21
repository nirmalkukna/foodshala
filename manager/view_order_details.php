<?php
   include('session_m.php');
   
   if(!isset($login_session)){
   header('Location: managerlogin.php'); // Redirecting To Home Page
   }
   
   ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Dashboard | FoodShala</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
    <div class="wrapper d-flex align-items-stretch">
      <nav id="sidebar">
        <div class="p-4 pt-5">
          <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(images/logo.jpg);"></a>
          <ul class="list-unstyled components mb-5">
            <li>
              <a href="myrestaurant.php">Dashboard</a>
            </li>
            <li>
              <a href="view_food_items.php">View Food Items</a>
            </li>
            <li>
              <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Add/Edit/Delete Items</a>
              <ul class="collapse list-unstyled" id="homeSubmenu">
                <li class="active">
                    <a href="add_food_items.php">Add Food Items</a>
                </li>
                <li>
                    <a href="edit_food_items.php">Edit Food Items</a>
                </li>
                <li>
                    <a href="delete_food_items.php">Delete Food Items</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="add_food_category.php">Add Food category</a>
            </li>
            <li class="active">
              <a href="view_order_details.php">View Order Details</a>
            </li>
          </ul>
        </div>
      </nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="myrestaurant.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Welcome <?php echo $login_session; ?> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout_m.php">Log Out </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

            <div class="col-lg-12">
      <div class="form-area">
        <form action="" method="POST">
        <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> YOUR FOOD ORDER LIST </h3>


<?php

// Storing Session
$user_check=$_SESSION['login_user1'];
$sql = "SELECT * FROM orders o WHERE o.R_ID IN (SELECT r.R_ID FROM restaurants r WHERE r.M_ID='$user_check') ORDER BY order_date";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{

  ?>

  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th>  </th>
        <th> Order ID </th>
        <th> Food ID </th>
        <th> Order Date </th>
        <th> Food Name </th>
        <th> Price </th>
        <th> Quantity </th>
        <th> Customer </th>
      </tr>
    </thead>

    <?PHP
      //OUTPUT DATA OF EACH ROW
      while($row = mysqli_fetch_assoc($result)){
    ?>

  <tbody>
    <tr>
      <td> <span class="glyphicon glyphicon-menu-right"></span> </td>
      <td><?php echo $row["order_ID"]; ?></td>
      <td><?php echo $row["F_ID"]; ?></td>
      <td><?php echo $row["order_date"]; ?></td>
      <td><?php echo $row["foodname"]; ?></td>
      <td><?php echo $row["price"]; ?></td>
      <td><?php echo $row["quantity"]; ?></td>
      <td><?php echo $row["username"]; ?></td>
    </tr>
  </tbody>
  
  <?php } ?>
  </table>
    <br>


  <?php } else { ?>

  <h4><center>0 RESULTS</center> </h4>

  <?php } ?>

        </form>

        
        </div>
      
    </div>

      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>