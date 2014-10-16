<?php
session_start();
$error = '';
if (isset($_SESSION['user']) ) {
    header('Location: ' . 'http://localhost/qa/home.php');
}
else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['username']) or ! isset($_POST['pwd'])) {
            $error = 'Username or password not entered.';
        }
        else {
            if (empty($_POST['pwd'])) { $error = 'No password entered.'; }
            $con = new mysqli("localhost", "devshubh", "", "qa") or die("Connection error.");
            $username = $con->real_escape_string($_POST['username']);
            $password = $con->real_escape_string($_POST['pwd']);

            $stm = $con->prepare('SELECT Username FROM user ' .
                   'WHERE Username = ?');
            $stm->bind_param('s', $username);
            $stm->execute();
            $stm->bind_result($uname);
            $stm->fetch();
            $stm->close();

            if ($uname == $username) { $error = 'User already exists.'; }
            else {
                $stm = $con->prepare('INSERT INTO user (Username,Password)' .
                       'VALUES (?,?)');
                $stm->bind_param('ss', $username, $password);
                $stm->execute();
                $stm->close();
                $con->close();

                header('Location: ' . 'http://localhost/qa/home.php');
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
  <script type="text/javascript">
  function myFunction() {
      var pwd = document.getElementById("pwd").value;
      var pwdcon = document.getElementById("pwdcon").value;
      var ok = true;
      if (pwd != pwdcon) {
          document.getElementById("pwd");
          document.getElementById("pwdcon");
          ok = false;
          alert("Passwords do not match!");
      }
      else {
          alert("Passwords Match!!!");
      }
    return ok;
   }
   </script>
    <title>Register | QA</title>
    <meta name="viewport" content="device-width, initial-scale=1.0" >
    
    <link href="css/bootstrap-fluid-adj.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
   
  </head>

  <body style="background-color: #B8B894">
    <div class="container">
      <form id="login-form" role="form" action="Register.php" method="post" onsubmit="return myFunction();">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <h2>Register</h2>
	    <hr><br>
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
              <input type="password" id="pwd" class="form-control" name="pwd" placeholder="Password" />
            </div>
          </div>
        </div>

	<div class="row">
          <div class="col-xs-6 col-md-4 col-md-offset-4">
            <div class="form-group">
              <input type="password" class="form-control" id="pwdcon" placeholder="Confirm Password" />
            </div>
          <?php echo '<p style="color: red">' . $error . '</p>'; ?>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6 col-md-4 col-md-offset-4">
          <input type="submit" value="Submit" class="btn btn-info btn-lg" />
          </div>
        </div>
      </form>
    </div>
    <script src="js/jquery-2.0.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
