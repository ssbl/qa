<?php
session_start();
$question = $_GET["question"];
$category = $_GET["category"];

if ($question == null or $category == null) { die("Question not found."); }
$con = new mysqli("localhost", "devshubh", "", "qa");
if ($con->connect_error) { die("Could not connect to DB" . mysqli_error()); }

$stm2 = $con->prepare("SELECT qtext, qdescription FROM questions WHERE qid = ?");
$stm2->bind_param('d', $question);
$stm2->execute();
$stm2->bind_result($qtext, $qdesc);
$stm2->fetch();
$stm2->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (! isset($_SESSION['user'])) {
        /* Redirect to registration */
    }
    else {
        /* Getting the user ID */
        $user = $_SESSION['user'];
        $stm3 = $con->prepare("SELECT UserId FROM user WHERE Username = ?");
        $stm3->bind_param('s', $user);
        $stm3->execute();
        $stm3->bind_result($userID);
        $stm3->fetch();
        $stm3->close();

        /* Adding the answer */
        if (! isset($_POST['txtDesc']) ) { die("Error."); }
        $answer_text = $_POST['txtDesc'];
        $stm4 = $con->prepare("INSERT INTO answers (answer_text,qid,UserId" .
                ",name) VALUES (?,?,?,?)");
        $stm4->bind_param('sdds', $answer_text, $question, $userID, $category);
        $stm4->execute();
        $stm4->close();

        header('Location: ' . 'http://localhost/qa/question.php?category=' .
                urlencode($category) . '&question=' . urlencode($question));
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
   <link href="css/bootstrap-fluid-adj.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($qtext); ?> | QA</title>
  </head>

  <body style="background-color: #B8B894">
  <a href="home.php" style="font-size: 20px" align="right"><span class="glyphicon glyphicon-home"></span>  Home</a>
    <div id="header" class="form-group">
      <h2 align="center"><?php echo htmlspecialchars($qtext); ?></h2>
      <hr>
    </div>
    <?php
    $form_action_url = 'question.php?category=' . urlencode($category) .
                       '&question=' . urlencode($question);
    ?>
    <div style="padding: 20px 200px 10px;">
      <form action="<?php echo $form_action_url; ?>" method="post">
	    <textarea class="form-control" name="txtDesc" row="50" cols="50" placeholder="Your answer..."
                  wrap="hard"></textarea><br><br>
	    <input class="form-control" type="submit" value="Add answer" name="submit"><br><br>
	  </form>
    </div>
    <?php
    $stm = $con->prepare("SELECT UserId, answer_text  FROM answers WHERE name = ? AND qid = ?");
    $stm->bind_param('sd', $category, $question);
    $stm->execute();
    $stm->bind_result($user, $answer_text);

    while ($stm->fetch()) {
        echo '<p><b>[' . $user . ' answered]</b> ';
        echo htmlspecialchars($answer_text) . '</p><br>';
    }

    $stm->close();
    $con->close();
    ?>
  </body>
</html>
