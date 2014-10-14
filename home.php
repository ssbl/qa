<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>QA</title>
  </head>

  <body>
    <h1>QA Homepage</h1>
    <p>A simple question-and-answer website.</p>
    <hr>

    <form id="qinstant">
      <input type="text" placeholder="Ask away!">

      <button type="button" name="submit">Post question</button>
    </form>
    <br>

    <h3>Popular categories</h3>
    <?php
    $con = new mysqli("localhost", "shubhaml", "", "qa");

    if ($con->connect_error) { die("Error connecting to DB: " . mysqli_error()); }

    $results = $con->query("SELECT * FROM category ORDER BY likes DESC LIMIT 5");

    /* List top 5 categories and number of `likes' */
    echo "<ul>";
    while ($row = $results->fetch_array()) {
        print "<li><a href='category.php?category=" . $row["name"] . "'>";
        print $row["name"] . "</a> (";
        print $row["likes"] . ")</li><br>";
    }
    echo "</ul>";
    
    ?>
    <div align="center">
      <a href="faq.html">FAQ</a>

    </div>

    <div id="footer">
      <p align="center"><small>--footer text--</small></p>
    </div>
  </body>
</html>
