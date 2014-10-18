<?php
session_start();
if (isset($_SESSION['user'])) { $logged_in = true; }
else {
    header('Location: ' . 'http://localhost/qa/login.php');
}
?>
<!DOCTYPE HTML style="height: 100%;">
<html style="height:100%;">
  <head>
    <link href="http://fonts.googleapis.com/css?family=Corben:bold" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Nobile" rel="stylesheet" type="text/css">
    <meta charset="utf-8" />
    <title>Frequently asked questions</title>
    <link href="css/bootstrap-fluid-adj.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </head>
  <body style="background-image:url(bg.jpg); font-family: 'Corben', Georgia, Times, serif;">
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
    <br><br><br> <div class="container" align="center">
      <h1 align="center"><span class="glyphicon glyphicon-question-sign"></span>   Frequently asked questions</h1><br>
      <hr><br>
      <script>

       function toggleElement(id)
       {
           if(document.getElementById(id).style.display == 'none')
           {
               document.getElementById(id).style.display = '';
           }
           else
           {
               document.getElementById(id).style.display = 'none';
           }
       }
      </script>
      <p>
        <a style="font-size: 25px; text-decoration: none;color: orange;" href="javascript:toggleElement('a1')"><span class="glyphicon glyphicon-plus"></span>  <em> What is this site about?</em></a><br><br><br>
        <a  style="font-size: 25px; text-decoration: none;color: orange;"href="javascript:toggleElement('a2')"><span class="glyphicon glyphicon-plus"></span>  <em> Who created this site?</em></a><br><br><br>
        <a  style="font-size: 25px; text-decoration: none;color: orange;"href="javascript:toggleElement('a3')"><span class="glyphicon glyphicon-plus"></span>  <em> Who is this site for?</em></a><br><br><br>
      </p>
      <div id="a1" style="display:none" class="well" align="center">
        This site is for users to ask or answer other user's questions.
      </div>
      <div id="a2" style="display:none" class="well" align="center">
        This site was created by Devansh Lala and Shubham Lagwankar studying Computer Engineering at TSEC.
      </div>
      <div id="a3" style="display:none" class="well" align="center">
        This site is for everyone who wishes to learn something new everyday.
      </div><br><br><br>
    </div>
  </body>
</html>
