<html>

  <head>
    <title> FoodShala </title>
      <link rel="stylesheet" type = "text/css" href ="../css/bootstrap.min.css">
      <script type="text/javascript" src="../js/jquery.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.min.js"></script>
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
          <a class="navbar-brand" href="../index.php">FoodShala</a>
        </div>

        <div class="collapse navbar-collapse " id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active" ><a href="../index.php">Home</a></li>
            <li><a href="../aboutus.php">About</a></li>
            <li><a href="../contactus.php">Contact Us</a></li>
          </ul>
        </div>

      </div>
    </nav>

<?php

require '../connection.php';
$conn = Connect();
$fullname = $conn->real_escape_string($_POST['fullname']);
$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$contact = $conn->real_escape_string($_POST['contact']);
$password = $conn->real_escape_string($_POST['password']);

$query = "INSERT into manager(fullname,username,email,contact,password) VALUES('" . $fullname . "','" . $username . "','" . $email . "','" . $contact . "','" . md5($password) ."')";
$success = $conn->query($query);

if (!$success){
  echo "Please try again or maybe user already registerd.";
} 

$conn->close();

?>


<div class="container">
	<div class="jumbotron" style="text-align: center;">
		<h2> <?php echo "Welcome $fullname!" ?> </h2>
		<h1>Your account has been created.</h1>
		<p>Login Now from <a href="index.php">HERE</a></p>
	</div>
</div>

    </body>
</html>