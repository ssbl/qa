<?php
$domain = "localhost/qa";

$answer_text = $_POST["answer_text"];
if ($answer_text == null) { die("Error."); }

if (isset($_POST["category"])) {
    $category = $_POST["category"];
}
else {
    $category = 'Miscellaneous';
}

if (!isset($_SESSION["user"])) {
    $user = 1234; # use test user for now
}
else {
    $user = intval($_SESSION["user"]);
}

$con = new mysqli("localhost", "devshubh", "", "qa");
if ($con->connect_error) { die("Error connecting to DB: " . mysqli_error()); }

$qtext = strip_tags($qtext);
$qtext = $con->real_escape_string($qtext);
$stm = $con->prepare("INSERT INTO questions (name,qtext,userID) VALUES " .
       "(?,?,?)") or die("Failed to prepare statement");
$stm->bind_param('ssd', $category, $qtext, $user);
$stm->execute();

$new_url = "http://" . $domain . "/question.php?category=" .
           urlencode($category) . "&question=" . urlencode($con->insert_id);

echo $new_url;
echo "Question added!";

$stm->close();
$con->close();

header("Location: " . $new_url);
die();
?>
