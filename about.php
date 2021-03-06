<?php
session_start();
if (isset($_SESSION['user'])) { $logged_in = true; }
else {
    header('Location: ' . 'http://localhost/qa/login.php');
}
?>

<!DOCTYPE html>
<html style="height:100%;">
  <head>
    <title>ABOUT | QA</title>
    <meta name="viewport" content="width=device-width, initial-scale=2.0" >
    <link href="http://fonts.googleapis.com/css?family=Corben:bold" rel="stylesheet" type="text/css">
 <link href="http://fonts.googleapis.com/css?family=Nobile" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-fluid-adj.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
  </head>
  <body style="background-image:url(bg.jpg); height:100%; font-family: 'Corben', Georgia, Times, serif;">
    <div class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color: #B6B6CF">
      <div class="container" >
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
            <li class="active"><a href="about.php" style="background-color: #B6B6CF">About</a></li>
	        <li><a href="faq.php">FAQ</a></li>
            <li><a href="contact.php">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container" >
      <div class="page-header" >
        <br><h1>About</h1>
      </div>
      <p>This is a question and answer website made so that users can interact and share their knowledge and experience with another by asking or answering questions on a variety of categories.
      This site aims to be an easy and efficient way for people to learn something new every second of their life.</p>
    </div>
  </body>
</html>
