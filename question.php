<?php
session_start();
?>
<?php
$question = htmlspecialchars($_GET["question"]);
$category = htmlspecialchars($_GET["category"]);

if ($question == null or $category == null) { die("Question not found."); }
$con = new mysqli("localhost", "devshubh", "", "qa");
if ($con->connect_error) { die("Could not connect to DB" . mysqli_error()); }

$stm2 = $con->prepare("SELECT qtext, qdescription FROM questions WHERE qid = ?");
$stm2->bind_param('d', $question);
$stm2->execute();
$stm2->bind_result($qtext, $qdesc);
$stm2->fetch();
$stm2->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title><?php echo htmlspecialchars($qtext); ?> | QA</title>
  </head>
  
  <body>
    <div id="header">
      <h2><?php echo htmlspecialchars($qtext); ?></h2>
      <hr>
      <?php
	if(isset(!_SESSION['user']))
	echo'You have not logged in';
	else{
	$con = new mysqli ("localhost","devshubh","","qa") or die(mysqli_error($con)); 
    	$sql = "SELECT UserId from user where Username=_SESSION['user']" ;
}	
        $category = ($_GET["category"]);
	$question = ($_GET["question"]);
      	if(isset($_POST['txtDesc'])){
        $con = new mysqli ("localhost","devshubh","","qa") or die(mysqli_error($con)); 
    	$desc = mysqli_real_escape_string($con,$_POST['txtDesc']);
    	$sql = "INSERT INTO answers (answer_text,qid,name) VALUES ('$desc','$question','$category')" ;
    	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
}
?>
	<form method="POST" action="">
	<textarea name="txtDesc" row = "50" cols = "50" id="txtDesc" wrap="hard"></textarea><br><br>
	<input type="submit" value="submit" name="submit"><br><br>
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
