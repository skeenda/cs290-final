<?php
session_start();
ini_set('display_errors', 'On');

echo '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset = "utf-8" />
	<title> Movie Login Home Page </title>
	<link rel= "stylesheet" href= "index.css">
</head>

<body>
	<h3 class="text-center">Welcome to your movie Library</h3><br><br>
	<div class="from-actions"><a href="login.php" class="btn btn-info" role="botton">LOGIN</a>
	<a href="register.php" class="btn btn-info" role="button">REGISTER</a></div>
</body>
</html>';

if(isset($_GET['action']) && $_GET['action'] == 'end'){
	$_SESSION = array();
	session_destroy();
}
?>