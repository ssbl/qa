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
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title><?php echo htmlspecialchars($_GET["category"]) ?> | QA</title>
  </head>

  <body>
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
        print '<li><a href="question.php?' . htmlentities($url) .
               '">' . $row["qtext"];
        print "</a></li><br>";
    }
    echo "</ul>\n";

    $rows->free();
    $con->close();
    ?>
  </body>
</html>
