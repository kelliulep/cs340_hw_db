<!DOCTYPE html>
<?php?>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
	</head>
<body>



<?php
	include 'connectvars.php'; 
	include 'header.php';	

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}	

$currentId = "geosuxks"; // temporary current user

$query = "SELECT Post.user_id, Post.title FROM Favorites, Post
			WHERE Favorites.postID = Post.postID 
			AND Favorites.UserID = '$currentId' ";

// Get results from query
$result = mysqli_query($conn, $query);
if (!$result) {
	die("Query to show fields from table failed");
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


?>
</body>

</html>