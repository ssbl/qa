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
        $answer_text = mysqli_real_escape_string($_POST['txtDesc']);
        $stm4 = $con->prepare("INSERT INTO answers (answer_text,qid,UserId" .
                ",name) VALUES (?,?,?,?)");
        $stm4->bind_param('sdds', $answer_text, $question, $userID, $category);
        $stm4->execute();

        header('Location: ' . 'http://localhost/qa/question.php?category=' .
                urlencode($category) . '&question=' . urlencode($question));
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($qtext); ?> | QA</title>
  </head>

  <body>
    <div id="header">
      <h2><?php echo htmlspecialchars($qtext); ?></h2>
      <hr>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<textarea name="txtDesc" row="50" cols="50" id="txtDesc" wrap="hard"></textarea><br><br>
	<input type="submit" value="Add answer" name="submit"><br><br>
	</form>
    <?php
    $stm = $con->prepare("SELECT answer_id, answer_text  FROM answers WHERE name = ? AND qid = ?");
    $stm->bind_param('sd', $category, $question);
    $stm->execute();
    $stm->bind_result($answer_id, $answer_text);

    while ($stm->fetch()) {
        /* $url = "category=" . urlencode($category) . "&question=" .
           urlencode($question); */
        echo htmlspecialchars($answer_text);
    }

    $stm->close();
    $con->close();

    ?>
  </body>
</html>
