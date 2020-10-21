<html>
   <head>
      <title> User Signup| FoodShala </title>
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
            <div class="collapse navbar-collapse " id="myNavbar">
               <ul class="nav navbar-nav">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="contactus.php">Contact Us</a></li>
               </ul>
               <ul class="nav navbar-nav navbar-right">
                  <li> <a href="customerlogin.php">Login</a></li>
                  <li class="active"> <a href="customersignup.php">Sign up</a></li>
              </ul>
            </div>
         </div>
      </nav>

    <div class="container">
      <div class="text-center">
          <h3>Customer Signup Now !</h3>
      </div>
    </div>



    <div class="container" style="margin-top: 2%; margin-bottom: 2%;">
      <div class="col-md-5 col-md-offset-4">
      <div class="panel panel-primary">
        <div class="panel-heading"> Create Customer Account </div>
        <div class="panel-body">
          
        <form role="form" action="customer_registered_success.php" method="POST">
         
          <div class="row">
          <div class="form-group col-xs-12">
            <label for="fullname"><span class="text-danger" style="margin-right: 5px;">*</span> Full Name: </label>
            <div class="input-group">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="fa fa-user-o" aria-hidden="true"></label>
            </span>
            </span>
              <input class="form-control" id="fullname" type="text" name="fullname" placeholder="Your Full Name" required="" autofocus="">
              
            </div>           
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="username"><span class="text-danger" style="margin-right: 5px;">*</span> Username: </label>
            <div class="input-group">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="fa fa-user" aria-hidden="true"></label>
            </span>
            </span>
              <input class="form-control" id="username" type="text" name="username" placeholder="Your Username" required="">
              
            </div>           
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="email"><span class="text-danger" style="margin-right: 5px;">*</span> Email: </label>
            <div class="input-group">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="fa fa-envelope" aria-hidden="true"></label>
            </span>
            </span>
              <input class="form-control" id="email" type="email" name="email" placeholder="Email" required="">              
            </div>           
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="contact"><span class="text-danger" style="margin-right: 5px;">*</span> Contact: </label>
            <div class="input-group">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="fa fa-phone" aria-hidden="true"></span></label>
            </span>
              <input class="form-control" id="contact" type="text" name="contact" placeholder="Contact" required="">              
            </div>           
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="category"> <span class="text-danger" style="margin-right: 5px;">*</span> Choose a category :  </label>
              <select id="category" name="category" style="float: right;padding: 5px 10px">
                <option value="veg">Vegetarian</option>
                <option value="non-veg">Non-vegetarian</option>
              </select>
            </div>
          </div>

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="address"><span class="text-danger" style="margin-right: 5px;">*</span> Address: </label>
            <div class="input-group">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="fa fa-home" aria-hidden="true"></label>
            </span>
              </span>
              <input class="form-control" id="address" type="text" name="address" placeholder="Address" required="">              
            </div>           
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="password"><span class="text-danger" style="margin-right: 5px;">*</span> Password: </label>
            <div class="input-group">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="fa fa-lock" aria-hidden="true"></span></label>
            </span>
              <input class="form-control" id="password" type="password" name="password" placeholder="Password" required="">
            </div>           
          </div>
        </div>

         <div class="row">
          <div class="form-group col-xs-12">
            <label for="password"><span class="text-danger" style="margin-right: 5px;">*</span> Confirm Password: </label>
            <div class="input-group">
              <span class="input-group-btn">
                <label class="btn btn-primary"><span class="fa fa-lock" aria-hidden="true"></span></label>
            </span>
              <input class="form-control" id="c_password" type="password" name="password" placeholder="Confirm Password" required="">              
            </div>           
          </div>
        </div>
        

        <div class="row">
          <div class="form-group col-xs-4">
              <button class="btn btn-primary" type="submit">Submit</button>
          </div>

        </div>
        <label style="margin-left: 5px;">or</label> <br>
       <label style="margin-left: 5px;"><a href="customerlogin.php">Have an account? Login.</a></label>

        </form>

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
              <li><a href="manager/index.php">Restaurant Login</a></li>
              <li><a href="manager/managersignup.php">Restaurant Signup</a></li>
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

<script type="text/javascript">
  var password = document.getElementById("password")
  , c_password = document.getElementById("c_password");

function validatePassword(){
  if(password.value != c_password.value) {
    c_password.setCustomValidity("Passwords Don't Match");
  } else {
    c_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
c_password.onkeyup = validatePassword;
</script>