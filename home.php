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

      <button type="submit" value="Submit" name="submit">Post question</button>
    </form>
    <br>

    <h3>Popular categories</h3>
    <?php
    $con = new mysqli("localhost", "shubhaml", "", "qa");

    if ($con->connect_error) { die("Error connecting to DB" . mysqli_error()); }

    $results = $con->query("SELECT * FROM category ORDER BY likes DESC LIMIT 5");

    while ($row = $results->fetch_array()) {
        print "<p> ";
        print $row["name"] . " ";
        print $row["likes"] . "</p><br>";
    }
    
    ?>
    <div align="center">
      <a href="faq.html">FAQ</a>

    </div>

    <div id="footer">
      <p align="center"><small>--footer text--</small></p>
    </div>
  </body>
</html>
