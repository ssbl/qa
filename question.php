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
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($qtext); ?> | QA</title>
  </head>

  <body>
    <div id="header">
      <h2><?php echo htmlspecialchars($qtext); ?></h2>
      <hr>
    </div>
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