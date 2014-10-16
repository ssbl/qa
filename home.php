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
  </head>

  <body>
    <div class="alert alert-warning">
      <a href="" class="close" data-dismiss="alert">&times;</a>
      <strong>Hello!</strong>     Welcome to the website!
    </div>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">QA</a>
      </div>
      <div>
        <ul class="nav navbar-nav">
      	  <li><a href="home.php">Home</a></li>
          <li class="active"><a href="Register.php">Register</a></li>
          <li><a href="login.php">Login</a></li>
          <li><a href="about.html">About</a></li>
	      
        </ul>
      </div>
    </nav>
	<div class="jumbotron">
	  <div class="bg-success">
	    <div class="container" >
	      
	      <img src="random.png" class="img-responsive" align="right" alt ="Logo" width="250" height="250">
	      <div class="col-xs-6 col-md-4 col-md-offset-4">
            <br> <h1>QA Homepage</h1>
            
            <p>A simple question-and-answer website.</p>
            
            <p><?php echo 'Welcome, <tt>' . $_SESSION['user'] . '</tt>.'; ?></p>
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
      <div class="form-group">
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
        
        ?></div>
      <nav class="navbar navbar-default navbar-fixed-bottom" role="footer">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">QA</a>
        </div>
        <div>
          <ul class="nav navbar-nav">
      	    <li><a href="home.php">Home</a></li>
            <li class="active"><a href="faq.html">FAQ</a></li>
            <li><a href="contact.html">Contact Us</a></li>
	        
          </ul>
        </div>
      </nav>
      <script src="js/jquery-2.0.3.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
  </body>
</html>
