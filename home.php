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

    <form id="qinstant" action="addq.php" method="post">
      <input type="text" name="qtext" placeholder="Ask away!">

      <button type="submit" name="submit">Post question</button>
    </form>
    <br>

    <h3>Popular categories</h3>
    <?php
    $con = new mysqli("localhost", "devshubh", "", "qa");

    if ($con->connect_error) { die("Error connecting to DB: " . mysqli_error()); }

    $results = $con->query("SELECT * FROM category ORDER BY likes DESC LIMIT 5");

    /* List top 5 categories and number of `likes' */
    echo "<ul>";
    while ($row = $results->fetch_array()) {
        $category = $row["name"];
        $url = 'category=' . urlencode($category);
        print '<li><a href="category.php?' . htmlentities($url) . '">';
        print $row["name"] . "</a> (";
        print $row["likes"] . ")</li><br>";
    }
    echo "</ul>";

    $results->free();
    $con->close();
    
    ?>
    <div align="center">
      <a href="faq.html">FAQ</a>

    </div>

    <div id="footer">
      <p align="center"><small>--footer text--</small></p>
    </div>
  </body>
</html>
