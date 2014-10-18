<?php
session_start();
if (isset($_SESSION['user'])) { $logged_in = true; }
else {
    header('Location: ' . 'http://localhost/qa/login.php');
}

$question = $_GET["question"];
$category = $_GET["category"];

if ($question == null or $category == null) { die("Question not found."); }
$con = new mysqli("localhost", "devshubh", "", "qa");
if ($con->connect_error) { die("Could not connect to DB" . mysqli_error()); }

$stm2 = $con->prepare("UPDATE category SET views = views + 1 WHERE name = ?");
$stm2->bind_param('s', $_GET["category"]);
$stm2->execute();

$stm2->close();

$stm2 = $con->prepare("SELECT qtext, qdescription FROM questions WHERE qid = ?");
$stm2->bind_param('d', $question);
$stm2->execute();
$stm2->bind_result($qtext, $qdesc);
$stm2->fetch();
$stm2->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (! isset($_SESSION['user'])) {

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
<html style="height: 100%;">
  <head>
<link href="http://fonts.googleapis.com/css?family=Corben:bold" rel="stylesheet" type="text/css">
 <link href="http://fonts.googleapis.com/css?family=Nobile" rel="stylesheet" type="text/css">	     
   <link href="css/bootstrap-fluid-adj.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($qtext); ?> | QA</title>
  </head>

  <body style="background-image:url(bg.jpg); height:100%; font-family: 'Corben', Georgia, Times, serif;">
    <div class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color: #B6B6CF">
      <div class="container">
        <div class="navbar-header" >
          <p class="navbar-brand">QA</p>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
      	    <li class="active"><a href="home.php" style="background-color: #B6B6CF">Home</a></li>
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
	        <li><a href="faq.php">FAQ</a></li>
            <li><a href="contact.php">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </div>
    <br><br><br>
    <div id="header" class="container">
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
    </div>
  </body>
</html>
