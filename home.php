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
      <title>Home | QA</title>
    <meta name="viewport" content="width=device-width, initial-scale=2.0" >
    <link href="http://fonts.googleapis.com/css?family=Corben:bold" rel="stylesheet" type="text/css">
 <link href="http://fonts.googleapis.com/css?family=Nobile" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-fluid-adj.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
  </head>
  <body style="font-family: 'Corben', Georgia, Times, serif; background-image:url(random.jpg);">
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
	<div class="jumbotron" style="background-image:url(random.jpg);">
      <div class="row">
        <div class="col col-md-6 col-md-offset-4">
          <h1>QA Homepage</h1>
          <p>A simple question-and-answer website.</p>
          <p><?php echo '<em>Welcome </em> ' . $_SESSION['user'] . '.'; ?></p>
        </div>
      </div>
	</div>
    <div class="container">
      <form id="qinstant" action="addq.php" method="post">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <textarea rows="5" name="qtext" placeholder="Ask away!" class="form-control"></textarea>
          </div>
        </div>
        <br>
        <?php
        $con = new mysqli("localhost", "devshubh", "", "qa");
        if ($con->connect_error) { die("Error connecting to DB: " . mysqli_error()); }
        $results = $con->query("SELECT * FROM category");
        echo '<div class="row"><div class="col-xs-6 col-md-4 col-md-offset-4">';
        echo '<select name="category" class="form-control">';
        while ($row = $results->fetch_array()) {
            $category = $row["name"];
            echo "<option>" . $category . "</option>";
        }
        echo '</select></div></div>';
        ?>
        <br><br><br>
        <div class="row">
          <div class="col-xs-6 col-md-4 col-md-offset-5">
            <button type="submit" name="submit" class="btn btn-info btn-lg">Post question</button>
          </div>
        </div>
      </form>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
          <h3><span class="glyphicon glyphicon-star-empty"></span><em> Popular Categories</em></h3><br>
          <?php
          $con = new mysqli("localhost", "devshubh", "", "qa");
          if ($con->connect_error) { die("Error connecting to DB: " . mysqli_error()); }

          $results = $con->query("SELECT * FROM category ORDER BY views DESC LIMIT 5");

          /* List top 5 categories and number of views */
          echo "<ul>";
          while ($row = $results->fetch_array()) {
              $category = $row["name"];
              $url = 'category=' . urlencode($category);
              print '<li><a style="font-size: 20px; color: orange;" href="category.php?' . $url . '">';
              print $row["name"] . "</a> (";
              print $row["views"] . ")</li><br>";
          }
          echo "</ul>";
          $results->free();
          $con->close();
          ?>
        </div>
      </div>
    </div>
    <script src="js/jquery-2.0.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
  </body>
</html>
