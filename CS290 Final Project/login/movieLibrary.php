<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "skeenda-db", "ZAledlGRy9zSTctN", "skeenda-db");


if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

echo '<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="utf-8" />
	<title>Your Movie Library List </title>
	<link rel="stylesheet" href="index.css">
	<script type="text/javascript" src="database.js"></script>
</head>
<body>';


if (isset($_SESSION['username'])){
	$image = "uploads/" . "$_SESSION[username]" . ".jpg";
	$imageLink = "http://web.engr.oregonstate.edu/~skeenda/cs290/FinalAssignment/login/" . $image;
	
	echo "<p><a href=index.php?action=end>Logout</a>";
	
	if(file_exists($image)){
		echo "<img src=\"$imageLink\" alt=\"user image\" height=\"100\" width=\"100\" />";
		
	}
	else{
		echo "<img src=\"http://web.engr.oregonstate.edu/~skeenda/cs290/FinalAssignment/uploads/default.jpg\" alt=\"user image\" height=\"100\" width=\"100\" />";
	}
	
	echo '<div class="userTop"><form action="upload.php" method="post" enctype="multipart/form-data">
	<span class="btn btn-info"><input type="file" name="fileToUpload" id="fileToUpload"></span>
  	<input type="submit" class="btn btn-info" value="Upload Image">
	</form></div>';

}
else{
	echo "<p>You kind sir/madam do not have an account yet! Click <a href=index.php>here</a> to login or register. </p>";
}



echo '
<div id="container"><div id="left"><form role="form" action="movieLibrary.php" method="post">
<legend>Add a movie to your Library: </legend>
<div class="col-xs-4">
	<label>Title:</label><br>
	<input type="text" id="title" name="title" class="form-control" required />
	<label>Genre: </label>
	<input type="text" name="genre" class="form-control" required />
	<label>Description:</label>
	<input type="text" name="description" class="form-control" required />
	<input type="submit" class="btn btn-info" value="Add Library">
</form></div>';

if(!$mysqli->query("CREATE TABLE IF NOT EXISTS movieLibrary(id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL)")){
	echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (isset($_POST['recommend']) && $_POST['recommend'] == 'self') {
  if (!($stmt = $mysqli->prepare("INSERT INTO movieLibrary(username, genre, description) VALUES (?, ?, ?)"))) {
    echo "Prepare failed: :".$stmt->errno." ".$stmt->error;
  }
  if (!$stmt->bind_param("sss", $_SESSION['username'], $_POST['genre'], $_POST['description'])) {
    echo "Bind failed: " .$stmt->errno." ".$stmt->error;
  }
  if (!$stmt->execute()) {
    echo "Execute failed: " .$stmt->errno." ".$stmt->error;
  }
  $stmt->close();
}

echo '<div id="right"><form>
	<legend>This is your Library</legend>
	<div id="tabelOutput"></div>

<div class="clear"></div>
</div>
</body>
</html>	'
?>




