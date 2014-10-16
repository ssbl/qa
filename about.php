<?php
session_start();
if (isset($_SESSION['user'])) { $logged_in = true; }
else {
    header('Location: ' . 'http://localhost/qa/login.php');
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>ABOUT | QA</title>
    <meta name="viewport" content="width=device-width, initial-scale=2.0" >
    
    <link href="css/bootstrap-fluid-adj.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
  </head>
  <body style="background-color: #B8B894">
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header" >
          <p class="navbar-brand">QA</p>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
      	    <li><a href="home.php">Home</a></li>
            <?php
            if ($logged_in) {
                echo '<li><a href="logout.php">Logout</a></li>';
            }
            else {
                header('Location: ' . 'http://localhost/qa/login.php');
            }
            ?>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="about.php">About</a></li>
	        <li><a href="faq.html">FAQ</a></li>
            <li><a href="contact.html">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="page-header">
        <br><h1>About</h1>
      </div>
      <p>This is a q/a site.</p>
    </div>
  </body>
</html>
