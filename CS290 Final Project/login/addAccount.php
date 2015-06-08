<?php
session_start();
ini_set('display_errors', 'On');

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "skeenda-db", "ZAledlGRy9zSTctN", "skeenda-db");
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

echo '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Your Movie Library: add Account</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>';
if(session_status() == PHP_SESSION_ACTIVE) {
  // If we supplied a name parameter
  if(isset($_POST['username'])) {
    // Set name as passed in parameter
    $_SESSION['username'] = $_POST['username'];
    echo "Thank you for registering, $_SESSION[username]!";
  }
}
echo "<p>Click <a href=movieLibrary.php>here</a> to proceed.</p>";
// Create table
if (!$mysqli->query("CREATE TABLE IF NOT EXISTS users(id INT AUTO_INCREMENT PRIMARY KEY,
                                       username VARCHAR(255) NOT NULL UNIQUE)")) {
    echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
// Hash password
$username = $_POST['username'];
//$password = $_POST['password'];
//$hashedPW = base64_encode(hash('sha256', $password));
// Add account
if (!($stmt = $mysqli->prepare("INSERT INTO users(username) VALUES (?)"))) {
  echo "Prepare failed: :".$stmt->errno." ".$stmt->error;
}
// string, string
if (!$stmt->bind_param("s", $username)) {
  echo "Bind failed: " .$stmt->errno." ".$stmt->error;
}
if (!$stmt->execute()) {
  echo "Execute failed: " .$stmt->errno." ".$stmt->error;
}
$stmt->close();
echo '</body>
</html>';
?>