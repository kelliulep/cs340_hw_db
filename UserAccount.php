<!DOCTYPE html>
<?php
		$currentpage="UserAccount";
		include "pages.php";
?>
<html>
	<head>
		<title>AdminInfo</title>
		<link rel="stylesheet" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- bootstrap stuff -->
		<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
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

	$currentId = "correct_time"; // temporary admin current user

	$query = "SELECT UserID, date, num_posts, num_favorites FROM Users WHERE UserID='$currentId' ";
	
// Get results from query
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
// get number of columns in table	
	$fields_num = mysqli_num_fields($result);
	
	echo "<h1>Account Info:</h1>";

	$row = mysqli_fetch_array($result);

	echo "<p> <b>Username:</b> " . $row['UserID']. "<p>";
	echo "<p> <b>Date Joined:</b> " . $row['date']. "<p>";
	echo "<p> <b>Number Posts:</b> " . $row['num_posts']. "<p>";
	echo "<p> <b>Number Favorites:</b> " . $row['num_favorites']. "<p>";


	$isAdminQuery = "SELECT * FROM Admins WHERE UserID = '$currentId'"; /// check if the currentID is an admin and show data based on if it is in the currentID 
	$result2 = mysqli_query($conn, $isAdminQuery);
	if (!$result2) {
		die("Can't tell if admin..");
	}
	$num = mysqli_num_rows($result2);

	//If admin show the banned users and a link to ban users
	if($num != 0) {
		//banned users
		$query = "SELECT * FROM BannedUsers ";

		$result2 = mysqli_query($conn, $query);
		if (!$result2) {
			die("Query to show fields from table failed");
		}

		// $row = mysqli_fetch_array($result2);

		// echo "<p>" . $row['']
		//get number of columns in table	
		$fields_num = mysqli_num_fields($result2);
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

		echo "<h2>Banned Users:</h2>";
		echo "<a href='BanUser.php'> Ban User </a>";
	}



	mysqli_free_result($result);
	mysqli_close($conn);
?>
</body>

</html>

	
