<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>HOME | QA</title>
    <meta name="viewport" content="width=device-width, initial-scale=2.0" >
    
    <link href="css/bootstrap-fluid-adj.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

  </head>

  <body>
<div class="alert alert-warning">
    <a href="" class="close" data-dismiss="alert">&times;</a>
    <strong>Hello!</strong>     Welcome to the website!
</div>
<div class="container">
  <nav class="navbar navbar-default">
       
      <div class="container-fluid">
        <div class="navbar-header" >
          <a class="navbar-brand" >QA</a>
        </div>
        <div>
	</div>
	
          <ul class="nav navbar-nav">
            <li class="active"><a href="home.php">Home</a></li>
            <li><a href="Register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="About.php">About</a></li>
          </ul>
	  </div>
	 
	  
	<div class="container">
	<div class="jumbotron">
	<img src="random.png" class="img-responsive" align="right" alt ="Logo" width="180" height="180">
	     <div class="col-xs-6 col-md-4 col-md-offset-4">
    <h1>QA Homepage</h1>
    
    <p>A simple question-and-answer website.</p>
    <p><?php echo '<em>Welcome, </em> ' . $_SESSION['user'] . '.'; ?></p>
    <hr>
	</div>
	</div>
	</div>
    <form id="qinstant" action="addq.php" method="post">

      <input type="text" name="qtext" placeholder="Ask away!" class="form-control">
      <br>
      <?php
      $con = new mysqli("localhost", "devshubh", "", "qa");
      if ($con->connect_error) { die("Error connecting to DB: " . mysqli_error()); }
      $results = $con->query("SELECT * FROM category");
     
      echo '<select name="category" class="form-control">';
      while ($row = $results->fetch_array()) {
          $category = $row["name"];
          echo "<option>" . $category . "</option>";
      }
      echo "</select>";
      ?>
     <br> <button type="submit" name="submit"class="btn btn-info btn-lg" >Post question</button>
    </form>
    <br>

    <h3><span class="glyphicon glyphicon-star-empty"></span>Popular Categories</h3>
    <?php
    $con = new mysqli("localhost", "devshubh", "", "qa");

    if ($con->connect_error) { die("Error connecting to DB: " . mysqli_error()); }

    $results = $con->query("SELECT * FROM category ORDER BY views DESC LIMIT 5");

    /* List top 5 categories and number of views */
    echo "<ul>";
    while ($row = $results->fetch_array()) {
        $category = $row["name"];
        $url = 'category=' . urlencode($category);
        print '<li><a href="category.php?' . $url . '">';
        print $row["name"] . "</a> (";
        print $row["views"] . ")</li><br>";
    }
    echo "</ul>";

    $results->free();
    $con->close();
    
    ?>
    <div align="center">
      <a href="faq.html">FAQ</a>

    </div>

    <div id="footer">
      <p align="center"><small>--footer text--</small></p>
    </div>
  </body>
</html>
