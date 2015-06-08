<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1); 
  
echo '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Your Movie Library</title>
	<link rel="stylesheet" href="index.css">
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
<h3>Login</h3><br>
<script>
	function validateForm(){
		if(document.getElementById("username").innerHTML == "This username is not registered."){
			alert("You should create an account my friend.");
			return false;
		}
		else{
			return true;
		}
	}
</script>
<form role="form" action="movieLibrary.php" method="post" onsubmit="return validateForm()">
<div class="col-xs-4">
	<label>USERNAME:</label>
	<input type="text" id="username" name="username" class="form-control" required /> <br>
	<input type="submit" class="btn btn-info" value="Login"> <br><br><br>
	
<p>Click <a href="register.php"> here</a> to sign up for an account.<p></div>


</body>
</html>'
?>