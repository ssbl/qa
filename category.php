<?php
session_start();
if (isset($_SESSION['user'])) { $logged_in = true; }
else {
    header('Location: ' . 'http://localhost/qa/login.php');
}

$con = new mysqli("localhost", "devshubh", "", "qa") or die("Connection error" .
       mysqli_error());
$stm2 = $con->prepare("UPDATE category SET views = views + 1 WHERE name = ?");
$stm2->bind_param('s', $_GET["category"]);
$stm2->execute();

$stm2->close();
?>

<!DOCTYPE html>
<html>
  <head>
   <link href="css/bootstrap-fluid-adj.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title><?php echo $_GET["category"] ?> | QA</title>
  </head>
  <body style="background-color: #B8B894">
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header" >
          <p class="navbar-brand">QA</p>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
      	    <li class="active"><a href="home.php">Home</a></li>
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
            <li><a href="about.php">About</a></li>
	        <li><a href="faq.html">FAQ</a></li>
            <li><a href="contact.html">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </div>
    <br><br><br><br>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
      <?php
      $category = $_GET["category"];
      if ($category == null) { die("Category does not exist!"); }

      $stm = "SELECT qid,qtext FROM questions WHERE name='$category'";
      $rows = $con->query($stm);

      echo "<ul>";
      while ($row = $rows->fetch_array()) {
          $question_id = $row["qid"];
          $url = "category=" . urlencode($category) . "&question=" .
                 urlencode($question_id);
          print '<li><a style="font-size: 20px; color:teal;" href="question.php?' . htmlentities($url) .
                 '">' . $row["qtext"];
          print "</a></li><br>";
      }
      echo "</ul>\n";

      $rows->free();
      $con->close();
      ?>
        </div>
      </div>
    </div>
  </body>
</html>
