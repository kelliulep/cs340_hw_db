<!DOCTYPE html>
<?php
		$currentpage="UserAccount";
		include "pages.php";
?>
<html>
	<head>
		<title>AdminInfo</title>
		<link rel="stylesheet" href="style.css">
	</head>
<body>


<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvars.php'; 
	include 'header.php';	

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}	

// query to select all information from supplier table
	$currentId = "zebra6"; // temporary nonadmin current user

	$query = "SELECT UserID, date, num_posts, num_favorites FROM Users WHERE UserID='$currentId' ";
	
// Get results from query
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
// get number of columns in table	
	$fields_num = mysqli_num_fields($result);
	echo "<h1>Account Info:</h1>";
	echo "<table id='t01' border='1'><tr>";
	
// printing table headers
	for($i=0; $i<$fields_num; $i++) {	
		$field = mysqli_fetch_field($result);	
		echo "<td><b>$field->name</b></td>";
	}
	echo "</tr>\n";
	while($row = mysqli_fetch_row($result)) {	
		echo "<tr>";	
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable	
		foreach($row as $cell)		
			echo "<td>$cell</td>";	
		echo "</tr>\n";
	}


	
	$isAdminQuery = "SELECT * FROM Admins WHERE UserID = '$currentId'"; /// check if the currentID is an admin and show data based on if it is in the currentID 
	$result2 = mysqli_query($conn, $isAdminQuery);
	if (!$result2) {
		die("Can't tell if admin..");
	}
	$num = mysqli_num_rows($result2);
	if($num != 0) {
		//banned users
		$query = "SELECT * FROM BannedUsers ";
		$result2 = mysqli_query($conn, $query);
		if (!$result2) {
			die("Query to show fields from table failed");
		}
		// get number of columns in table	
		$fields_num = mysqli_num_fields($result2);
		echo "<h2>Banned Users:</h2>";
		echo "<table id='t01' border='1'><tr>";
		
	// printing table headers
		for($i=0; $i<$fields_num; $i++) {	
			$field = mysqli_fetch_field($result2);	
			echo "<td><b>$field->name</b></td>";
		}
		echo "</tr>\n";
		while($row = mysqli_fetch_row($result2)) {	
			echo "<tr>";	
			// $row is array... foreach( .. ) puts every element
			// of $row to $cell variable	
			foreach($row as $cell)		
				echo "<td>$cell</td>";	
			echo "</tr>\n";
		}
	}



	mysqli_free_result($result);
	mysqli_close($conn);
?>
</body>

</html>

	
