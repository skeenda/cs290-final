<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title> Your Movie Library: Table</title>
</head>
<body>
<?php
	session_start();
	ini_set('display_errors', 'On');
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "skeenda-db", "ZAledlGRy9zSTctN", "skeenda-db");
	
	$source = $_GET['q'];
	$username = $_SESSION['username'];
	
	if (!($stmt = $mysqli->prepare("SELECT DISTINCT title, genre, description FROM movieLibrary WHERE source = ? AND username = ? ORDER BY title ASC"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	if (!$stmt->bind_param("ss", $source, $username)) {
		echo "Bind failed: " .$stmt->errno." ".$stmt->error;
	}
	if (!$stmt->execute()) {
		echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	
	$out_title = NULL;
	$out_genre = NULL;
	$out_description =NULL;
	if(!$stmt->bind_result($out_title, $out_genre, $out_description)){
		echo "Binding has failed";
	}
	
	echo '<table class="table table-striped">
	<tr>
	<th>Title
	<th>Genre
	<th>Description';
	
	while($stmt->fetch()){
		printf("<tr><td>%s <td>%s <td>%s <br>"), $out_title, $out_genre, $out_description);
	}
	
	$stmt->close();
	?>
	</body>
	</html>