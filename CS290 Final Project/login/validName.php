<?php
session_start();
ini_set('display_errors', 'On');
header('Content-Type: text/html');
echo '<?xml version="1.0" encoding="utf-8" standalone="yes" ?>';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "skeenda-db", "ZAledlGRy9zSTctN", "skeenda-db");


echo '<response>';

if(session_status() == PHP_SESSION_ACTIVE){
	if(isset($_GET['username'])){
		$_SESSION['username'] == $_GET['username'];
		$username = $_GET['username'];
	}
}

$stmt = $mysqli->prepare("SELECT username FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows >= 1) {
  echo "Username is already taken.";
}
else if ($username == "") {
    echo "Please enter a username.";
}
$stmt->close();
echo '</response>';
?>
