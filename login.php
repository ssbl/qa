<?php
$con = new mysqli("localhost", "devshubh", "", "qa");
$error = '';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $con->real_escape_string($_POST["username"]);
    $password = $con->real_escape_string($_POST["pwd"]);

    $stm = $con->prepare('SELECT Username,Password FROM user ' .
           'WHERE Username = ? ' .
           'AND Password = ?') or die("Query error: " . mysqli_error());
    $stm->bind_param('ss', $username, $password);
    $stm->execute();
    $stm->bind_result($db_username, $db_password);
    $stm->fetch();
    $stm->close();

    if ($username !== $db_username || $password != $db_password) {
        $error = '<br><p style="color: red">Invalid username or password.</p>';
    }
    else {
        $_SESSION['user'] = $username;

        header('Location: ' . 'http://localhost/qa/home.php');
    }
}    
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login | QA</title>
    <meta name="viewport" content="device-width, initial-scale=1.0" >
    
    <link href="css/bootstrap-fluid-adj.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
  </head>

  <body style="background-color: #B8B894">
    <div class="container">
      <form id="login-form" role="form" action="login.php" method="post">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <h2>Login</h2>
        </div>
        
        <div class="row">
          <div class="col-xs-6 col-md-4 col-md-offset-4">
            <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username" />
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-xs-6 col-md-4 col-md-offset-4">
            <div class="form-group">
              <input type="password" class="form-control" name="pwd" placeholder="Password" />
              <?php echo $error; ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-6 col-md-4 col-md-offset-4">
          <button type="submit" class="btn btn-info btn-lg">Submit</button>
          </div>
        </div>
      </form>
    </div>
    <script src="js/jquery-2.0.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
