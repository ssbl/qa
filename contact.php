<?php
session_start();
if (isset($_SESSION['user'])) { $logged_in = true; }
else {
    header('Location: ' . 'http://localhost/qa/login.php');
}
?>
<!DOCTYPE HTML style="height: 100%;">
<html style="height: 100%;">
  <head>
    <link href="http://fonts.googleapis.com/css?family=Corben:bold" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Nobile" rel="stylesheet" type="text/css">
    <title>Contact Us | QA</title>
    <meta name="viewport" content="width=device-width, initial-scale=2.0" >
    
    <link href="css/bootstrap-fluid-adj.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

  </head>
  <body style="background-image:url(bg.jpg); height:100%; font-family: 'Corben', Georgia, Times, serif;">
    <div class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color: #B6B6CF">
      <div class="container" >
        <div class="navbar-header"  >
          <p class="navbar-brand">QA</p>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav" >
      	    <li class="active"><a href="home.php" style="background-color: #B6B6CF">Home</a></li>
            <?php
            if ($logged_in) {
                echo '<li><a href="logout.php" style="background-color: #B6B6CF">Logout</a></li>';
            }
            else {
                header('Location: ' . 'http://localhost/qa/login.php');
            }
            ?>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
            <li><a href="about.php">About</a></li>
	        <li><a href="faq.php">FAQ</a></li>
            <li><a href="contact.php">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container">
   <br><br><br> <h1 align="center">Contact Us</h1>
    <hr>
    <p>This project was made by Devansh Lala and Shubham Lagwankar for the TSEC WT Project.
      Contact us at github@Codekrypt or ssbl.</p>
    </div>
  </body>
</html>
