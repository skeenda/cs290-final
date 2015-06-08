<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Your Movie Library: Register</title>
  <link rel="stylesheet" href="index.css">
  <script type="text/javascript" src="script.js"></script>
</head>
<body>
<h3>Register</h3> <br>
<script>
  function validateForm() {
    if (document.getElementById("username").innerHTML == "Username is already taken.") {
      alert("Please try a different username. The username entered is not available.");
      return false;
    }
  }
</script>
  <form role ="form" action="addAccount.php" method="post" onsubmit="return validateForm()">
  <div class="col-xs-4">
    <label>Username:</label>
    <input type="text" id="username" name="username" onkeyup="processName()" class="form-control" required /> <span id="nameValid"></span> <br>
    <input type="submit" class="btn btn-info" value="Register"> <br> <br>
  </form>
  <p>Already registered? Click <a href="login.php">here</a> to login.<p></div>
</body>
</html>';
?>