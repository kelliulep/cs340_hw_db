<!DOCTYPE html>
<?php?>
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

$query = "SELECT postID, user_id, title FROM Post ";

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
	if($i > 0){
		echo "<td><b>$field->name</b></td>";
	}
}
echo "</tr>\n";
while($row = mysqli_fetch_row($result)) {
	echo "<tr>";
	// $row is array... foreach( .. ) puts every element
	// of $row to $cell variable
	$count = 1;
	foreach($row as $cell){
		global $id;
		if($count == 1){
			$id = $cell;
		}
		else if($count == 3){
		echo "<td><a href='viewPost.php?post=$id'>$cell</a></td>";
		}
		else{
			echo "<td>$cell</td>";
		}
		$count=$count+1;
	}
	echo "</tr>\n";
}


?>
</body>

</html>
