<?php
session_start();

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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title><?php echo htmlspecialchars($_GET["category"]) ?> | QA</title>
  </head>
  <div class="form-group">
  <a href="home.php" style="font-size: 20px" align="right"><span class="glyphicon glyphicon-home"></span>  Home</a>
  <h1 align="center">Questions</h1>
  <br>
  <hr>
  <body style="background-color: #B8B894">
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
  </body>
</html>
