<!DOCTYPE html>
<?php
	session_start();
?>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<script type = "text/javascript"  src = "verifyInput.js" > </script>
	</head>
<body>


<?php
	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	
	include 'header.php';
	
	/*$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	} //dont need right now*/	

	// query to select all information from supplier table
	$currentId = "zebra6"; // temporary nonadmin current user

	$query = "SELECT user_id, title FROM Post ";

	// Get results from query
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}

	$categories = "SELECT DISTINCT category FROM Post";
	$catResult = mysqli_query($conn, $categories);
	while($row = mysqli_fetch_row($catResult)) {	
		echo "<div>";	
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable	
		foreach($row as $cell)		
			echo "<button>$cell</button>";	
		echo "</div>\n";
	}


	// get number of columns in table	
	$fields_num = mysqli_num_fields($result);
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
	mysqli_close($conn);



?>
</body>

</html>
