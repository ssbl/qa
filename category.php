<?php
/* echo "You selected the " . htmlspecialchars($_GET["category"]) . " category!"; */
$category = htmlspecialchars($_GET["category"]);

if ($category == null) { die("Category does not exist!"); }

$con = new mysqli("localhost", "devshubh", "", "qa");
if ($con->connect_error) { die("Could not connect to DB: " . mysqli_error()); }

$stm = $con->query("SELECT qtext,qid FROM questions WHERE name = " . $category);
echo "<ul>";
while ($row = $stm->fetch_array()) {
        print "<li><a href='question.php?category=$row["name"]" . $row["qtext"] . "'>";
        print $row["qtext"] . "</a> (";
	print $row["qid"] . ")</li><br>";
	}
echo "</ul>";
?>
