<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Home | QA</title>
    <meta name="viewport" content="width=device-width, initial-scale=2.0" >
    
    <link href="css/bootstrap-fluid-adj.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </head>

  <body style="background-color: #B8B894">
    <div class="alert alert-warning">
      <a href="" class="close" data-dismiss="alert">&times;</a>
      <strong>Hello!</strong>     Welcome to the website!
    </div>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color: #B8B894">
      <div class="navbar-header" style="background-color: #B8B894">
        <p class="navbar-brand">QA</p>
      </div>
      <div>
        <ul class="nav navbar-nav">
      	  <li class="active"><a href="home.php">Home</a></li>
          <li><a href="Register.php">Register</a></li>
          <li><a href="login.php">Login</a></li>
	  </ul>
	  <ul class="nav navbar-nav navbar-right">
          <li><a href="about.html">About</a></li>
	  <li><a href="faq.html">FAQ</a></li>
          <li><a href="contact.html">Contact Us</a></li>
	      
        </ul>
      </div>
    </nav>
	<div class="jumbotron" style="background-color: #B8B894">
	  <div class="bg-success" style="background-color: #B8B894">
	    <div class="container" style="background-color: #B8B894">
	      
	      <div class="col-xs-6 col-md-4 col-md-offset-4">
             <h1>QA Homepage</h1>
            <p>A simple question-and-answer website.</p>
            <p><?php echo '<em>Welcome </em> ' . $_SESSION['user'] . '.'; ?></p>
            <hr>
	      </div>
	    </div>
	  </div>
      <form id="qinstant" action="addq.php" method="post">
         <div class="col-xs-6 col-md-4 col-md-offset-4">
          <br> <input type="text" name="qtext" placeholder="Ask away!" class="form-control"></div>
          <br>
          <?php
          $con = new mysqli("localhost", "devshubh", "", "qa");
          if ($con->connect_error) { die("Error connecting to DB: " . mysqli_error()); }
          $results = $con->query("SELECT * FROM category");
          echo'  <div class="col-xs-6 col-md-4 col-md-offset-4">';
          echo '<br><br><select name="category" class="form-control">';
          while ($row = $results->fetch_array()) {
              $category = $row["name"];
              echo "<option>" . $category . "</option>";
          }
          echo '</select></div>';
          ?>
          <br><br><br><br><br> <div class="col-xs-6 col-md-4 col-md-offset-4">
<br><br> <button type="submit" name="submit" class="btn btn-info btn-lg">Post question</button>
</div>
      </form>
    <br>
    <div class="form-group">
     <br><br><br> <h3><span class="glyphicon glyphicon-star-empty"></span><em>Popular Categories</em></h3><br>
      <?php
      $con = new mysqli("localhost", "devshubh", "", "qa");
      if ($con->connect_error) { die("Error connecting to DB: " . mysqli_error()); }

      $results = $con->query("SELECT * FROM category ORDER BY views DESC LIMIT 5");

      /* List top 5 categories and number of views */
      echo "<ul>";
      while ($row = $results->fetch_array()) {
          $category = $row["name"];
          $url = 'category=' . urlencode($category);
          print '<li><a style="font-size: 20px; color:teal;" href="category.php?' . $url . '">';
          print $row["name"] . "</a> (";
          print $row["views"] . ")</li><br>";
      }
      echo "</ul>";

    $results->free();
    $con->close();
    
    ?></div>
    
    <script src="js/jquery-2.0.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
