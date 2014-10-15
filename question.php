<?php
$question = htmlspecialchars($_GET["question"]);
$category = htmlspecialchars($_GET["category"]);

if ($question == null or $category == null) { die("Question not found."); }

$con = new mysqli("localhost", "devshubh", "", "qa");
if ($con->connect_error) { die("Could not connect to DB" . mysqli_error()); }

$stm = "SELECT * FROM answers WHERE name='$category' AND qid = '$question'";

$rows = $con->query($stm);
while ($row = $rows->fetch_array()) {
        $answer_id = $row["answer_id"];
        $url = "category=" . urlencode($category) . "&question=" .
               urlencode($question_id);
        print '<p>' . $row["answer_text"];
        print "</p><br>";
}

$rows->free();
$con->close();

?>